<?php



namespace App\Http\Controllers;

use App\Models\InfoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 5);
        $data = InfoModel::orderBy('created_at', 'desc')->paginate($perPage);
        return response()->json($data);
    }

    public function show($id)
    {
        $data = InfoModel::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'informasi' => 'required',
                'tag' => 'required',

            ],
            [
                'title.required' => 'Kolom  wajib diisi.',
                'informasi.required' => 'Kolom  wajib diisi.',
                'tag.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        try {
            InfoModel::create($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'informasi' => 'required',
                'tag' => 'required',

            ],
            [
                'title.required' => 'Kolom  wajib diisi.',
                'informasi.required' => 'Kolom  wajib diisi.',
                'tag.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $findId = InfoModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = InfoModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    public function destroy($id)
    {
        $findId = InfoModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = InfoModel::findOrFail($id);
            $data->delete();
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }
}
