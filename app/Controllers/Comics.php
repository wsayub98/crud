<?php

namespace App\Controllers;

use App\Models\ComicsModel;

use function PHPUnit\Framework\throwException;

class Comics extends BaseController
{
    protected $comicsModel;

    public function __construct()
    {
        $this->comicsModel = new ComicsModel();
    }

    public function index()
    {
        //$comics = $this->comicsModel->findAll();

        $data = [
            'title' => 'Comics | AMS',
            'comics' => $this->comicsModel->getComic()
        ];

        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Comic Detail | AMS',
            'comics' => $this->comicsModel->getComic($slug),
        ];

        if (empty($data['comics'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Comic ' . $slug . ' not found');
        }

        return view('comics/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add Comic | AMS',
            'validation' => \Config\Services::validation(),
        ];

        return view('comics/create', $data);
    }

    public function save()
    {
        //input validatoin
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[comics.title]',
                'errors' => [
                    'required' => 'The comic {field} is required.',
                    'is_unique' => 'The comic {field} is already registered.',
                ]
            ],
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,3072]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Please choose any image first.',
                    'max_size' => 'File size is exceeded 3MB',
                    'is_image' => 'File choosen is not an image type.',
                    'mime_in' => 'File choosen is not an image type.',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
            return redirect()->to('/comics/create')->withInput();
        }

        $fileImage = $this->request->getFile('image');
        $fileImage->move('img'); //move file to img folder
        $imageName = $fileImage->getName(); //get file name

        $slug = url_title($this->request->getVar('title'), '-', true);

        $this->comicsModel->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'image' => $imageName,
        ]);

        session()->setFlashdata('message', 'Data is Successfully Created.');

        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        $this->comicsModel->delete($id);

        session()->setFlashdata('message', 'Data is Successfully Deleted.');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Comic | AMS',
            'validation' => \Config\Services::validation(),
            'comics' => $this->comicsModel->getComic($slug),
        ];

        return view('comics/edit', $data);
    }

    public function update($id)
    {
        // dd($this->request->getVar());
        //input validatoin
        $existcomic = $this->comicsModel->getComic($this->request->getVar('slug'));
        if ($existcomic['title'] == $this->request->getVar('title')) {
            $comic_title = 'required';
        } else {
            $comic_title = 'required|is_unique[comics.title]';
        }

        if (!$this->validate([
            'title' => [
                'rules' => $comic_title,
                'errors' => [
                    'required' => 'The comic {field} is required.',
                    'is_unique' => 'The comic {field} is already registered.',
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);

        $this->comicsModel->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'image' => $this->request->getVar('imagec'),
        ]);

        session()->setFlashdata('message', 'Data is Successfully Edited.');

        return redirect()->to('/comics');
    }
}
