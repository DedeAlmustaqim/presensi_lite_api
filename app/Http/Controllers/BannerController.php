<?php



namespace App\Http\Controllers;

use App\Models\BannerModel;
use App\Models\InfoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $data = BannerModel::orderBy('created_at', 'desc')->paginate();
        return response()->json($data);
    }

  

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'img_path' => 'required',
                

            ],
            [
                'title' => 'required',
                'img_path' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        try {
            BannerModel::create($validatedData);
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
                'img_path' => 'required',
                

            ],
            [
                'title' => 'required',
                'img_path' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $findId = BannerModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = BannerModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    public function destroy($id)
    {
        $findId = BannerModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = BannerModel::findOrFail($id);
            $data->delete();
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }
}
