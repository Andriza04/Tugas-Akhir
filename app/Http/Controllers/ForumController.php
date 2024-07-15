<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\komentar_pertanyaan;
use App\Models\tag;
use App\Models\Pertanyaan;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function create(){
        $pertanyaan = Pertanyaan::orderBy('created_at','asc')->get();
        $user = User::where('id', '!=', Auth::user()->id)->get();
        return view('user.create', compact('pertanyaan','user'));
    }
    public function store(Request $request){

        $tags_arr = explode(',',$request["tags"]);

        // looping array
        // array kosong
        $tags_id = [];
        foreach($tags_arr as $tag_name){
            // mencari tagname
            $tag = tag::firstOrCreate(['tag_name' => $tag_name]);
            $tags_id[] = $tag->id;
        }

        $pertanyaan = new Pertanyaan;
        $pertanyaan->judul = $request->Judul;
        $pertanyaan->isi = $request->isi;
        $pertanyaan->user_id = auth()->user()->id;
        $pertanyaan->save();

        // menyimpan id
        $pertanyaan->tags()->sync($tags_id);
        // menambahkan ke pertayaan_id  baru di pertanyaan_tags
        $user = Auth::user();


        // Pertanyaan::create(['judul' => $request->judul, 'isi' => $request->isi, 'user_id' => $request->profile]);
        return redirect('/');
    }
    public function show($id){
        $pertanyaan = Pertanyaan::find($id);
        $user = User::where('id', '!=', Auth::user()->id)->get(); // unutk menampilkan yanng tiak di follow
        return view('user.show', compact('pertanyaan','user'));
    }

    public function komentar_pertanyaan(Request $request, $id){
            $komentar = new komentar_pertanyaan;
            $komentar->isi = $request->komentar;
            $komentar->user_id = auth()->user()->id;
            $komentar->pertanyaan_id = $id;
            $komentar->save();
        return redirect('/forum/show/' . $id)->with('sukses', 'data anda berhasil di tambahkan');
    }
    // untuk follow
    public function follower($id){
        $follower = new Follower;
        $follower->user_id = auth()->user()->id;
        $follower->follow_id = $id;
        $follower->save();


        return back();
    }
    public function unfollow($id){
        $unfollow = Follower::where('user_id',Auth::user()->id)
                    ->where('follow_id', $id)
                    ->delete();
        return back();
    }
    public function edit($id){
        $user = User::where('id', '!=', Auth::user()->id)->get();
        $pertanyaan = Pertanyaan::find($id);
        return view('user.edit', compact('pertanyaan','user'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'judul' => 'required',
            'isi' => 'required'
        ]);
        Pertanyaan::where('id', $id)
            ->update(['judul' => $request->judul, 'isi' => $request->isi]);
        
        return back()->with('Error', 'data anda berhasil di hapus');
    }
    public function destroy($id){
        Pertanyaan::where('id', $id)->delete();
        return redirect('/')->with('eror', 'data anda berhasil di hapus');
    }
}
