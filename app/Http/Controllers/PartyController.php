<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\Belong;
use Illuminate\Support\Facades\Auth;

class PartyController extends Controller {

    public function getParties() {

        try {
            
            return Party::all();

        } 
        
        catch(QueryException $error) {

            return $error;

        }

    }

    public function addParty(Request $request) {

        // El uso de "Auth::id()" permite conseguir el id de usuario del token recibido para poder limitar los endpoints a solo permitir el id de la persona logueada y por lo tanto evitar que se pueda colocar el id de otro usuario.

        $user = Auth::id();
        $name = $request->input('name');
        $game = $request->input('gameId');

        try {

            // Aquí primero insertamos el registro en la tabla "Parties", y luego en la tabla "Belongs" para así poder luego buscar los miembros de cada party.

            $party = Party::create([

                    'owner' => $user,
                    'name' => $name,
                    'gameId' => $game

                ]);

            Belong::create([

                    'userId' => $user,
                    'partyId' => $party["id"]

                ]);

        } 
        
        catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            return response()->json([

                'error' => $codigoError

            ]);
            
        }

    }

    public function joinParty(Request $request) {

        $userId = Auth::id();
        $partyId = $request->input('partyId');

        try {

            // Aquí verificamos que el usuario no sea miembro de la party a la que se quiera unir para evitar registros duplicados. Si la respuesta regresa vacía, entonces se procede a añadir el registro.

            $joinParty = Belong::where('userId', '=', $userId)->where('partyId', '=', $partyId)->get();

            if ($joinParty->isNotEmpty()) {

                return "You are already a member in that party";

            } 
            
            else {

                return Belong::create([

                    'userId' => $userId,
                    'partyId' => $partyId

                ]);

            }

        } 
        
        catch (QueryException $error) {

            $codigoError = $error->errorInfo[1];

            return response()->json([

                'error' => $codigoError

            ]);
            
        }

    }

    public function getMyParties() {

        $id = Auth::id();

        try {

            // Se realiza un Join de las 3 tablas relacionadas para dejar abierta la posibilidad de mostrar cualquier dato que se requiera de alguna de las tablas.

            return Party::selectRaw('belongs.partyId, parties.name, users.id as userId, users.userName')
            ->join('belongs', 'belongs.partyId', '=', 'parties.id')
            ->join('users', 'users.id', '=', 'belongs.userId')
            ->where('belongs.userId', '=', $id)
            ->get();

        } 
        
        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            return response()->json([

                'error' => $errorCode

            ]);
            
        }

    }

    public function getPartyMembers(Request $request) {

        $userId = Auth::id();
        $partyId = $request->input('partyId');

        try {

            $party = Party::selectRaw('belongs.partyId, parties.name, users.id, users.userName')
            ->join('belongs', 'belongs.partyId', '=', 'parties.id')
            ->join('users', 'users.id', '=', 'belongs.userId')
            ->where('parties.Id', '=', $partyId)
            ->orderByRaw('IF(users.id ='.$userId.', 0,1)')
            ->get();

            // Anteriormente hemos ordenado poniendo de primer lugar en el array de respuesta, el id del usuario logueado (en caso que exista) para luego poder verificar si la persona logueada pertenece o no a la party.
            // Si pertenece, se mostrarán todos los integrantes de la party, de lo contrario, mostrará un mensaje de error diciendo que no se es miembro de la party

            if ($party[0]['id'] === $userId) {
                
                return $party;

            } else {

                return response()->json([

                'error' => "You are not a member of searched party"

            ]);

            }

        } 
        
        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            return response()->json([

                'error' => $errorCode

            ]);
            
        }

    }

    public function quitParty(Request $request) {

        $userId = Auth::id();
        $partyId = $request->input('partyId');

        try {

            return Belong::where('userId', '=', $userId)->where('partyId', '=', $partyId)->delete($userId);

        }

        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            return response()->json([

                'error' => $errorCode

            ]);
            
        }

    }

    public function kickFromParty(Request $request) {

        $userId = Auth::id();
        $partyId = $request->input('partyId');
        $userToKick = $request->input('userId');

        try {

            // Aquí verificamos que el usuario sea el creador de la party, ya que solo el creador podría eliminar a un miembro de la party. De lo contrario, no se procede a la expulsión del usuario de dicha party.

            return Belong::selectRaw('belongs.userId, belongs.partyId')
            ->join('parties', 'parties.id', '=', 'belongs.partyId')
            ->join('users', 'users.id', '=', 'belongs.userId')
            ->where('parties.owner', '=', $userId)
            ->where('parties.Id', '=', $partyId)
            ->where('belongs.userId', '=', $userToKick)
            ->delete($userToKick);

        }

        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            return response()->json([

                'error' => $errorCode

            ]);
            
        }

    }

    public function removeParty(Request $request) {

        $userId = Auth::id();
        $partyId = $request->input('partyId');

        try {

            // Aquí verificamos que el usuario sea el creador de la party, ya que solo el creador podría eliminarla, de ser correcto se procede con la solicitud. De lo contrario no hará nada.

            return Party::where('owner', '=', $userId)->where('id', '=', $partyId)->delete($partyId);

        }

        catch (QueryException $error) {

            $errorCode = $error->errorInfo[1];

            return response()->json([

                'error' => $errorCode

            ]);
            
        }

    }
    
}
