<?php
class view{
    private $_file;
    private $_t;

    public function __construct($action){
        $this->_file = 'views/view'.$action.'.php';
    }

    //genere et affiche la vue
    /**
     * @param $data
     * @throws Exception
     */
    public function generate($data){
        //partie specifique de la vue
        $content = $this->generateFile($this->_file, $data);

        //template
        $view = $this->generateFile('view/template.php', array('t' => $this->_t, 'content' => $content));

        echo $view;
    }

    //genere un fichier vue et renvoie le resultat
    /**
     * @param $file
     * @param $data
     * @return false|string
     * @throws Exception
     */
    private function generateFile($file, $data){
        if(file_exists($file)){
            extract($data);

            ob_start();

            //inclu le fichier vue
            require $file;

            return ob_get_clean();
        }
        else
            throw new Exception('Fichier '.$file.' introuvable');
    }
}
