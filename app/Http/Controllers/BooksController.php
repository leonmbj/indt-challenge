<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BooksController extends Controller
{

    public $apiUrl = 'https://bibliapp.herokuapp.com/api/';

    /**
     * Index function
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('index');
    }

    /**
     * Master import function
     *
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function import(Request $request)
    {

        // Validate
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:txt,csv',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator);
        }

        // Publish api
        try {
            $this->apiPublishAuthorsAndBooks($this->loadFileNormalize($request->file('file')->getRealPath()));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            return view('index', ['otherError' => $error]);
        }

        return view('index', ['success' => 1]);

        // To return as json
        /*return '<pre>' .
            json_encode([
                'books' => json_decode($this->listBooks()),
                'authors' => json_decode($this->listAuthors())
            ]) . '</pre>';*/

    }


    /**
     * Api to save Books and Authors
     *
     * @param array $authors
     */
    public function apiPublishAuthorsAndBooks(Array $authors)
    {

        $cli = new Client(['base_uri' => $this->apiUrl]);

        foreach ($authors as $author => $authorData) {

            $postDataAuthor = ['firstName' => $authorData['firstName'], 'lastName' => $authorData['lastName']];
            $saveAuthor = $cli->request('POST', 'authors/upsertWithWhere?where=' . urlencode(json_encode($postDataAuthor)), [
                'json' => $postDataAuthor
            ]);

            if ($saveAuthor->getStatusCode() === 200) {

                $resData = json_decode($saveAuthor->getBody()->getContents());
                $books = $authors[$resData->firstName . ' ' . $resData->lastName]['books'];

                foreach ($books as $book) {

                    $postDataBook = ['title' => $book, 'authorId' => $resData->id];
                    $saveBook = $cli->request('POST', 'books/upsertWithWhere?where=' . urlencode(json_encode($postDataBook)), [
                        'json' => $postDataBook
                    ]);

                }
            }
        }
    }


    /**
     * Load file and convert it to array
     *
     * @param String $file
     * @return array|string
     */
    public function loadFileNormalize(String $file)
    {
        try {
            $csv = fopen($file, 'r');
            $authors = [];

            while (($data = fgetcsv($csv, 1000, ",")) !== FALSE) {

                $fullName = trim(htmlspecialchars($data[1]));
                $book = trim(htmlspecialchars($data[0]));
                $splitName = $this->split_name($fullName);

                if (strtolower($book) == 'livro' || strtolower($book) == 'livros') {
                    continue;
                }

                if (!array_key_exists($fullName, $authors)) {

                    $authors[$fullName] = [
                        'id' => null,
                        'firstName' => $splitName[0],
                        'lastName' => $splitName[1],
                        'books' => [
                            $book
                        ]
                    ];
                } else {
                    $authors[$fullName]['books'][] = $book;
                }
            }

            return $authors;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Separate firstName and lastName
     *
     * @param $name
     * @return array
     */
    public function split_name($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }


    /**
     * List authors as json
     *
     * @return mixed
     */
    public function listAuthors()
    {
        $cli = new Client(['base_uri' => $this->apiUrl]);
        $authors = $cli->request('GET', 'authors');

        return response()->json($authors->getBody()->getContents())->getData();
    }


    /**
     * Get author by id and return json
     *
     * @param $id
     * @return mixed
     */
    public function getAuthorById($id)
    {
        $cli = new Client(['base_uri' => $this->apiUrl]);
        $authors = $cli->request('GET', 'authors/' . $id);

        return response()->json($authors->getBody()->getContents())->getData();
    }


    /**
     * List books as json
     *
     * @return mixed
     */
    public function listBooks()
    {
        $cli = new Client(['base_uri' => $this->apiUrl]);
        $books = $cli->request('GET', 'books');

        return response()->json($books->getBody()->getContents())->getData();
    }


    /**
     * List books and authors as json, to show them
     *
     * @return mixed
     */
    public function listBooksAndAuthors()
    {
        $cli = new Client(['base_uri' => $this->apiUrl]);

        $booksRequest = $cli->request('GET', 'books');

        $booksArray = json_decode(response()->json($booksRequest->getBody()->getContents())->getData(), true);

        $books = [];

        foreach ($booksArray as $book) {

            $authorRequest = $cli->request('GET', 'authors/' . $book['authorId']);

            $authorArray = json_decode(response()->json($authorRequest->getBody()->getContents())->getData(), true);

            $books[] = [
                'title' => $book['title'],
                'author' => $authorArray['firstName'] . ' ' . $authorArray['lastName']
            ];
        }

        return response()->json($books)->getData();
    }


    /**
     * Function to delete a set of authors (dev)
     *
     * @return mixed
     */
    public function deleteAuthors()
    {
        for ($i = 237; $i <= 280; $i++) {
            $cli = new Client(['base_uri' => $this->apiUrl]);
            $return = $cli->request('DELETE', 'authors/' . $i);
        }

        return response()->json($return->getBody()->getContents())->getData();
    }


    /**
     * Function to delete a set of books (dev)
     *
     * @return mixed
     */
    public function deleteBooks()
    {
        for ($i = 1; $i <= 20; $i++) {
            $cli = new Client(['base_uri' => $this->apiUrl]);
            $return = $cli->request('DELETE', 'books/' . $i);
        }

        return response()->json($return->getBody()->getContents())->getData();
    }
}