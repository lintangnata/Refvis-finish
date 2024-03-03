<?php

namespace App\Controllers;
use App\Models\FotoModel;
use App\Models\UserModel;
use App\Models\AlbumDataModel;
use App\Models\LikeModel;
use App\Models\KomenModel;
use App\Models\AlbumModel;

class User extends BaseController
{
    protected $FotoModel;
    protected $UserModel;
    protected $AlbumDataModel;
    protected $LikeModel;
    protected $KomenModel;
    protected $AlbumModel;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->FotoModel = new FotoModel();
        $this->UserModel = new UserModel();
        $this->AlbumDataModel = new AlbumDataModel();
        $this->LikeModel = new LikeModel();
        $this->KomenModel = new KomenModel();
        $this->AlbumModel = new AlbumModel();
    }

    public function home(): string
    {
        // ambil data user berdasarkans ession
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $foto = $this->FotoModel->orderBy('id_foto', 'RANDOM')->findAll();

        $data = [
            'user' => $user,
            'foto' => $foto
        ];

        return view('user/home', $data);
    }

    public function create(): string
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();

        $data = [
            'user' => $user
        ];

        return view('user/create', $data);
    }

    public function createsave()
    {
        // ambil gambar
        $fileDokumen = $this->request->getFile('foto');
        $newName = $fileDokumen->getRandomName();
        $fileDokumen->move('foto_storage', $newName);

        $this->FotoModel->save([
            'judul' => $this->request->getVar('judul'),
            'desk' => $this->request->getVar('desk'),
            'kategori' => $this->request->getVar('kategori'),
            'id_user' => $this->session->get('id_user'),
            'foto' => $newName,
        ]);

        $id_foto = $this->FotoModel->insertID();

        $this->AlbumDataModel->save([
            'id_album' => '22',
            'id_user' => $this->session->get('id_user'),
            'id_foto' => $id_foto
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/home');
    }

    public function foto($id_foto)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $foto = $this->FotoModel->where('id_foto', $id_foto)->first();
        $uploader = $this->UserModel->where('id_user', $foto['id_user'])->first();
        $liked = $this->LikeModel->where('id_foto', $id_foto)->where('id_user', $userTake)->first();
        $julahLike = $this->LikeModel->where('id_foto', $id_foto)->countAllResults();
        $komen = $this->KomenModel->where('id_foto', $id_foto)->findAll();
        $ses = $this->session->get('id_user');
        
        $takeIdAlbum =  $this->AlbumDataModel->where(['id_foto' => $id_foto])->findAll();

        $idAlbum = array_column($takeIdAlbum, 'id_album');

        $albumAdd = $this->AlbumModel->whereNotIn('id_album', $idAlbum)->where(['id_user' => $ses])->findAll();

        $albumDel = $this->AlbumModel->whereIn('id_album', $idAlbum)->where(['id_user' => $ses])->findAll();

        $data = [
            'uploader' => $uploader,
            'user' => $user,
            'foto' => $foto,
            'liked' => $liked,
            'userTake' => $userTake,
            'jumlahLike' => $julahLike,
            'komen' => $komen,
            'albumAdd' => $albumAdd,
            'albumDel' => $albumDel
        ];

        return view('user/foto', $data);
    }

    public function edit($id_foto)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $foto = $this->FotoModel->where('id_foto', $id_foto)->first();
        $uploader = $this->UserModel->where('id_user', $foto['id_user'])->first();
        $liked = $this->LikeModel->where('id_foto', $id_foto)->where('id_user', $userTake)->first();
        $jumlahLike = $this->LikeModel->where('id_foto', $id_foto)->countAllResults();

        $data = [
            'uploader' => $uploader,
            'user' => $user,
            'foto' => $foto,
            'liked' => $liked,
            'userTake' => $userTake,
            'jumlahLike' => $jumlahLike
        ];

        return view('user/edit', $data);
    }

    public function like($id)
    {
        $this->LikeModel->save([
            'id_foto' => $id,
            'id_user' => $this->session->get('id_user')
        ]);

        return redirect()->to('/foto/' . $id);
    }

    public function unlike($id)
    {
        $this->LikeModel->where(['id_foto' => $id, 'id_user' => $this->session->get('id_user')])->delete();

        return redirect()->to('/foto/' . $id);
    }

    public function delete($id)
    {
        $this->FotoModel->where('id_foto', $id)->delete();
        return redirect()->to('/home');
    }

    public function komentarsave($id)
    {
        $this->KomenModel->save([
            'id_foto' => $id,
            'id_user' => $this->session->get('id_user'),
            'isi_komen' => $this->request->getVar('komentar')
        ]);

        return redirect()->to('/foto/' . $id);
    }

    public function updatefoto($id)
    {
        // ambil gambar
        $fileDokumen = $this->request->getFile('foto');

        // jika tidak ada gambar yang diupload maka gunakan gambar yang lama
        if ($fileDokumen->getError()
            == 4) {
            $newName = $this->FotoModel->where('id_foto', $id)->first()['foto'];
        } else {
            $newName = $fileDokumen->getRandomName();
            $fileDokumen->move('foto_storage', $newName);
        }

        $this->FotoModel->save([
            'id_foto' => $id,
            'judul' => $this->request->getVar('judul'),
            'desk' => $this->request->getVar('desk'),
            'kategori' => $this->request->getVar('kategori'),
            'id_user' => $this->session->get('id_user'),
            'foto' => $newName,
        ]);

        return redirect()->to('/foto/' . $id);
    }

    public function komentardelete($id)
    {
        $this->KomenModel->where('id_komen', $id)->delete();
        return redirect()->back();
    }

    public function profile($id)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $userProfile = $this->UserModel->where('id_user', $id)->first();
        $foto = $this->FotoModel->where('id_user', $id)->findAll();
        $album = $this->AlbumModel->where('id_user', $id)->findAll();

        $data = [
            'user' => $user,
            'userProfile' => $userProfile,
            'foto' => $foto,
            'album' => $album,
            'userTake' => $userTake,
        ];

        return view('user/profile', $data);
    }

    public function profilelike($id)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $userProfile = $this->UserModel->where('id_user', $id)->first();
        // ambil foto yang di like
        $foto = $this->FotoModel->join('laike', 'laike.id_foto = foto.id_foto')->where('laike.id_user', $id)->findAll();

        $data = [
            'user' => $user,
            'userProfile' => $userProfile,
            'foto' => $foto,
            'userTake' => $userTake,
        ];

        return view('user/profile-like', $data);
    }

    public function profilepost($id)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $userProfile = $this->UserModel->where('id_user', $id)->first();
        // ambil foto yang di miliki oleh userTake
        $foto = $this->FotoModel->where('id_user', $id)->findAll();

        $data = [
            'user' => $user,
            'userProfile' => $userProfile,
            'foto' => $foto,
            'userTake' => $userTake,
        ];

        return view('user/profile-post', $data);
    }

    public function editprofile($id)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $userProfile = $this->UserModel->where('id_user', $id)->first();

        $data = [
            'user' => $user,
            'userProfile' => $userProfile
        ];

        return view('user/editprofile', $data);
    }

    public function updateprofile($id)
    {

        // ambil gambar
        $fileDokumen = $this->request->getFile('foto');

        // jika tidak ada gambar yang diupload maka gunakan gambar yang lama
        if ($fileDokumen->getError()
            == 4) {
            $newName = $this->UserModel->where('id_user', $id)->first()['foto'];
        } else {
            $newName = $fileDokumen->getRandomName();
            $fileDokumen->move('user_pp', $newName);
        }

        $this->UserModel->save([
            'id_user' => $id,
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'foto' => $newName
        ]);

        return redirect()->to('/profile/' . $id);
    }

    public function albumsave()
    {
        $fileDokumen = $this->request->getFile('foto');
        // ganti nama file dengan 'cover' + random angka 5 digit
        $newName = 'cover' . rand(10000, 99999) . '.' . $fileDokumen->getClientExtension();
        $fileDokumen->move('album_cover', $newName);


        $this->AlbumModel->save([
            'nama' => $this->request->getVar('nama'),
            'desk' => $this->request->getVar('desk'),
            'id_user' => $this->session->get('id_user'),
            'foto' => $newName
        ]);

        session()->setFlashdata('pesan', 'Album Berhasil Ditambahkan');
        return redirect()->to('/profile/' . $this->session->get('id_user'));
    }

    public function album($id)
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $album = $this->AlbumModel->find($id);
        $take = $this->AlbumDataModel->where(['id_album' => $id])->findAll();

        // ambil id_galeri dari $take
        $id_foto = array_column($take, 'id_foto');

        // ambil data foto dari id_galeri yang sama dengan id_galeri di $take
        if (empty($id_foto)) {
            session()->setFlashdata('pesan', 'Album :' . $album['nama'] . ' Masih Kosong');
            return redirect()->back();
        }

        $foto = $this->FotoModel->whereIn('id_foto', $id_foto)->findAll();

        $data = [
            'user' => $user,
            'album' => $album,
            'foto' => $foto
        ];


        return view('user/album', $data);
    }

    public function savetoalbum($id_foto)
    {
        $this->AlbumDataModel->save([
            'id_album' => $this->request->getVar('saveto'),
            'id_user' => $this->session->get('id_user'),
            'id_foto' => $id_foto
        ]);

        session()->setFlashdata('pesan', 'Foto Berhasil Ditambahkan ke Album' );
        return redirect()->to('/foto/' . $id_foto);
    }

    public function deletealbum($id)
    {
        // ambil data dari form
        $id_album = $this->request->getVar('delfrom');

        // ambil data dari tabel albumdata
        $take = $this->AlbumDataModel->where(['id_album' => $id_album])->findAll();

        // ambil id_galeri dari $take
        $id_foto = array_column($take, 'id_foto');

        // hapus data dari tabel albumdata
        $this->AlbumDataModel->where(['id_album' => $id_album])->delete();

        session()->setFlashdata('pesan', 'Foto Berhasil Dihapus Dari Album');
        return redirect()->to('/foto/' . $id);
    }

    public function search()
    {
        $userTake = $this->session->get('id_user');
        $user = $this->UserModel->where('id_user', $userTake)->first();
        $keyword = $this->request->getVar('search');
        // ambil data foto berdasarkan keyword yang di cari oleh user dari judul foto dan deskripsi foto
        $foto = $this->FotoModel->like('judul', $keyword)->orLike('desk', $keyword)->findAll();

        $data = [
            'foto' => $foto,
            'user' => $user
        ];

        return view('user/search', $data);
    }
    
    public function downloadfoto($id)
    {
        $dataFile = $this->FotoModel->getFoto($id);
        $fileExtension = pathinfo($dataFile['foto'], PATHINFO_EXTENSION);
        $NamaFile = $dataFile['judul'] . '.' . $fileExtension;
        return $this->response->download('foto_storage/' . $dataFile['foto'], null)->setFileName($NamaFile);
    }

}
