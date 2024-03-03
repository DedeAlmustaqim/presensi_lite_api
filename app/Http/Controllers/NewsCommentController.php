<?php



namespace App\Http\Controllers;

use App\Models\NewsCommentModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsCommentController extends Controller
{
    

    public function get_comments(Request $request)
    {
        $id = $request->input('id');

        $perPage = request('per_page', 5);

        // Buat instance dari NewsCommentModel
        $newsCommentModel = new NewsCommentModel();

        // Panggil metode usersJoin melalui instance yang dibuat
        $data = $newsCommentModel->usersJoin()
            ->select('users.name', 'users.img', 'news_comments.*')
            ->where('id_news', $id)
            ->orderBy('news_comments.created_at', 'desc') // Sesuaikan dengan nama kolom yang sesuai di tabel
            ->paginate($perPage);

        return response()->json($data);
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_user' => 'required',
                'id_news' => 'required',
                'comment' => 'required',

            ],
            [
                'id_user.required' => 'Kolom  wajib diisi.',
                'id_news.required' => 'Kolom  wajib diisi.',
                'comment.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 201);
        }

        $validatedData = $validator->validated();
        $userCommentCount = NewsCommentModel::where('id_user', $validatedData['id_user'])->where('id_news', $validatedData['id_news'])->count();
        if ($userCommentCount >= 5) {
            return response()->json(['success' => false, 'message' => 'Anda telah mencapai batas komentar. Tidak bisa memberikan komentar lagi.'], 201);
        }
    
        try {
            NewsCommentModel::create($validatedData);
            return response()->json(['success' => true, 'message' => 'Berhasil memberikan komentar'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memberikan Komentar'], 500);
        }
    }
    

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                
                
                'comment' => 'required',

            ],
            [
                                
                'comment.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $findId = NewsCommentModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = NewsCommentModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    public function destroy($id)
    {
        $findId = NewsCommentModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = NewsCommentModel::findOrFail($id);
            $data->delete();
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }
}
