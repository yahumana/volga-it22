<?php 
    require_once 'libs/rb-postgres.php';

    R::setup('pgsql:host=localhost;dbname=englishstudy', 'app', '1', false);

    if (!R::testConnection()){
        R::close();
        exit('Ошибка');
    }


    function getDictionaries(){
        $dictionaries = R::findAll('dictionary');
        $json = array();

        foreach ($dictionaries as $dictionary){
            array_push($json, array('name' => $dictionary['name'], 
                                'id' => $dictionary['id'],
                                'length' => R::count('words', 'dictionary_id = ?', array($dictionary['id']))));
        }

        return json_encode($json);
    }


    function getDictionary($id=0){
        if ($id == 0 and array_key_exists('dictionary-id', $_SESSION)){
            $id = $_SESSION['dictionary-id'];
        }

        $id = $_SESSION['dictionary-id'];

        $dictionary = R::findOne('dictionary', 'id = ?', array($id));

        if (isset($dictionary['id'])){
            $json = array('dictionary' => array('name'=>$dictionary['name']), 'words' => array());
            $words = $dictionary->xownWordsList;
            foreach ($words as $word){
                array_push($json['words'], array('eng' => $word['eng'],
                                    'rus' => $word['rus'],
                                    'photo' => $word['photo']));
            }

            return json_encode($json);
        }

        return json_encode(array('error' => 'error'));
    }


    function getAllWords(){
        $words = R::findAll('words');

        $json = array();
        foreach ($words as $word){
            array_push($json, array("eng"=>$word['eng'], "rus"=>$word['rus'], "dictionary"=>$word->dictionary['name']));
        }

        return json_encode($json);
    }