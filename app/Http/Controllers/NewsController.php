<?php



namespace App\Http\Controllers;


use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        $perPage = request('per_page', 5);
        $data = NewsModel::orderBy('created_at','desc')->paginate($perPage);
        return response()->json($data);
    }

    public function show($id)
    {
        $data = NewsModel::find($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'content' => 'required',
                'thumbnail' => 'required',

            ],
            [
                'title.required' => 'Kolom  wajib diisi.',
                'content.required' => 'Kolom  wajib diisi.',
                'thumbnail.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        try {
            NewsModel::create($validatedData);
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
                'content' => 'required',
                'thumbnail' => 'required',

            ],
            [
                'title.required' => 'Kolom  wajib diisi.',
                'content.required' => 'Kolom  wajib diisi.',
                'thumbnail.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $findId = NewsModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = NewsModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    public function destroy($id)
    {
        $findId = NewsModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = NewsModel::findOrFail($id);
            $data->delete();
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }
}
