<?php
/**
 * @package	upload2.0
 * @version 2.0.a (derni�re r�vision le 07-11-2003)
 * @author	Olivier VEUJOZ <o.veujoz@miasmatik.net>
 * SECURITY CONSIDERATION: If you are saving all uploaded files to a directory accesible with an URL, remember to filter files not only by mime-type (e.g. image/gif), but also by extension. The mime-type is reported by the client, if you trust him, he can upload a php file as an image and then request it, executing malicious code.
 I hope I am not giving hackers a good idea anymore than I am giving it to good-intended developers. Cheers.
 Some restrictive firewalls may not let file uploads happen via a form with enctype="multipart/form-data".
 We were having problems with an upload script hanging (not returning content) when a file was uploaded through a remote office firewall. Removing the enctype parameter of the form allowed the form submit to happen but then broke the file upload capability. Everything but the file came through. Using a dial-in or other Internet connection (bypassing the bad firewall) allowed everything to function correctly.
 So if your upload script does not respond when uploading a file, it may be a firewall issue.
 * Compatibilit� :
 - compatible safe_mode
 - compatible open_basedir pour peu que les droits sur le r�pertoire temporaire d'upload soit allou�
 - marche avec les chemins relatifs et absolu
 - test� sous environnement Linux/Windows sous Apache 1.3
 - test� avec les version PHP 4.2.0, 4.3.1, 4.3.4
 - Version minimum de php : 4.2.0
 * Par d�faut :
 - autorise tout type de fichier
 - autorise les fichier allant jusqu'� la taille maximale sp�cifi�e dans le php.ini
 - envoie le(s) fichier(s) dans le r�pertoire de la classe
 - estime le temps d'execution du script par rapport � un modem 33.6Ko
 - n'affiche qu'un champ de type file
 - permet de laisser les champs de fichiers vides
 - �crase le fichier s'il existe d�j�
 - n'ex�cute aucune v�rification
 * Notes :
 - le chemin de destination peut �tre soit absolu soit relatif
 - si $SecurityMax est positionn� � "true", la classe va ignorer tout type de fichier rentrant dans la cat�gorie des application/octetstream
 - set_time_limit n'a pas d'effet lorsque PHP fonctionne en mode safe mode . Il n'y a pas d'autre solution que de changer de mode, ou de modifier la dur�e maximale d'ex�cution dans le php.ini
 - la variable $UploadErreur (type bool) est r�utilisable dans vos scripts afin de tester le bon d�roulement des op�rations. S'il y a eu des erreurs, la variable est positionn�e � "true".
 */

global $UploadError;

class Upload {

    /**
     * Taille maximum exprim�e en kilo-octets pour l'upload d'un fichier.
     * Type : num�rique
     * Valeur par d�faut : celle configur�e dans le php.ini
     * @access public
     */
    var $MaxFilesize;

    /**
     * Largeur maximum d'une image exprim�e en pixel.
     * Type : entier
     * Valeur par d�faut : null (aucune v�rification)
     * @access public
     */
    var $ImgMaxWidth;

    /**
     * Hauteur maximum d'une image exprim�e en pixel.
     * Type : entier
     * Valeur par d�faut : null (aucune v�rification)
     * @access public
     */
    var $ImgMaxHeight;

    /**
     * Largeur minimum d'une image exprim�e en pixel.
     * Type : entier
     * Valeur par d�faut : null (aucune v�rification)
     * @access public
     */
    var $ImgMinWidth;

    /**
     * Hauteur minimum d'une image exprim�e en pixel.
     * Type : entier
     * Valeur par d�faut : null (aucune v�rification)
     * @access public
     */
    var $ImgMinHeight;

    /**
     * R�pertoire de destination dans lequel vont �tre charg� les fichiers. Accepte les chemins relatifs et absolus
     * Type : chaine
     * Valeur par d�faut : chaine vide (le r�pertoire dans lequelle est situ�e la classe upload sera d�sign� comme chemin de destination)
     * @access public
     */
    var $DirUpload;

    /**
     * D�bit de la connexion utilisateur, exprim�e en kilobit, sur laquelle sera bas�e le calcul de la fonction set_time_limit
     * Type : valeur num�rique
     * Valeur par d�faut : 33.6
     * @access public
     */
    var $Debit;

    /**
     * Nombre de champs de type file que la classe devra g�rer.
     * Type : entier
     * Valeur par d�faut : 1
     * @access public
     */
    var $Fields;

    /**
     * Param�tres � ajouter aux champ de type file (ex: balise style, �venements JS...)
     * Type : chaine
     * Valeur par d�faut : chaine vide
     * @access public
     */
    var $FieldOptions;

    /**
     * D�finit si les champs sont obligatoires ou non.
     * Type : bool�en
     * Valeur par d�faut : false
     * @access public
     */
    var $Required;

    /**
     * Politique de s�curit� max : ignore tous les fichiers ex�cutables / interpr�table.
     * Type : bool�en
     * Valeur par d�faut : false
     * @access public
     */
    var $SecurityMax;

    /**
     * Permet de pr�ciser un nom pour le fichier � uploader. Peut s'utiliser conjointement avec les propri�t�s $Suffixe / $Prefixe
     * Type : chaine
     * Valeur par d�faut : chaine vide
     * @access public
     */
    var $Filename;

    /**
     * Pr�fixe pour un nom de fichier
     * Type : chaine
     * Valeur par d�faut : chaine vide
     * @access public
     */
    var $Prefixe;

    /**
     * Suffixe pour un nom de fichier
     * Type : chaine
     * Valeur par d�faut : chaine vide
     * @access public
     */
    var $Suffixe;

    /**
     * M�thode � employer pour l'�criture des fichiers :
     *  0 : si un fichier de m�me nom est pr�sent dans le r�pertoire, il est �cras� par le nouveau fichier
     *  1 : si un fichier de m�me nom est pr�sent dans le r�pertoire, le nouveau fichier est upload� mais pr�c�d� de la mention 'copie_de_'
     *  2 : si un fichier de m�me nom est pr�sent dans le r�pertoire, le nouveau fichier est ignor�
     * Type : entier compris entre 0 et 2
     * Valeur par d�faut : 0
     * @access public
     */
    var $WriteMode;

    /**
     * Indique s'il faut v�rifier la provenance du formulaire d'upload des fichiers. Si la chaine est vide, aucune v�rification n'est effectu�e.
     * Pour lancer la v�rification, il faut indiquer l'URI du formulaire de soumission des donn�es.
     * Type : chaine
     * Valeur par d�faut : chaine vide
     * @access public
     */
    var $CheckReferer;

    /**
     * Chaine de caract�res repr�sentant les ent�tes de fichiers autoris�s (mime-type).
     * Les ent�tes doivent �tre s�par�es par des points virgules.
     * Type : chaine
     * Valeur par d�faut : chaine vide (tout type d'ent�te autoris�)
     * @access public
     */
    var $MimeType;

    /**
     * D�finit si les erreurs de configuration de la classe doivent �tre affich�es en sortie �cran et doivent stopper le script courant.
     * Type : bool�en
     * Valeur par d�faut : true
     * @access public
     */
    var $TrackError;



    /***********************************************************************************
								METHODES PUBLIQUES										
	***********************************************************************************/

    /**
     * Constructeur
     *
     * @access public
     * @return object   initialise les valeurs par d�faut
     */
    function Upload() {
        $this-> Extension    = '';
        $this-> DirUpload    = '';
        $this-> MimeType     = '';
        $this-> Filename     = '';
        $this-> FieldOptions = '';
        $this-> Fields       = 1;
        $this-> WriteMode    = 0;
        $this-> Debit        = 33.6;
        $this-> SecurityMax  = false;
        $this-> CheckReferer = false;
        $this-> Required     = false;
        $this-> TrackError   = true;
        $this-> ArrOfError   = Array();
        $this-> MaxFilesize  = str_replace('M', '', ini_get('upload_max_filesize')) * 1024;
    }



    /**
     * Lance l'initialisation de la classe pour la g�n�ration du formulaire
     * @access public
     */
    function InitForm() {
        $this-> SetMaxFilesize();
        $this-> CreateFields();
    }



    /**
     * Retourne le tableau des erreurs survenues durant l'upload
     *
     * <code>
     * if ($UploadError) {
     *     print_r($Upload-> GetError);
     * }
     * </code>
     *
     * @access public
     * @param integer $num_field    num�ro du champ 'file' sur lequel on souhaite r�cup�rer l'erreur
     * @return array                tableau des erreurs
     */
    function GetError($num_field='') {
        if (Empty($num_field)) return $this-> ArrOfError;
        else                  return $this-> ArrOfError[$num_field];
    }



    /**
     * Retourne le tableau contenant les informations sur les fichiers upload�s
     *
     * <code>
     * if (!$UploadError) {
     *     print_r($Upload-> GetSummary());
     * }
     * </code>
     *
     * @access public
     * @param integer $num_field    num�ro du champ 'file' sur lequel on souhaite r�cup�rer les informations
     * @return array                tableau des infos fichiers
     */
    function GetSummary($num_field='') {
        if ($num_field == '') return $this-> Infos;
        else                  return $this-> Infos[$num_field];
    }



    /**
     * Lance les diff�rents traitements n�cessaires � l'upload
     * @access public
     */
    function Execute() {
        $this-> CheckConfig();
        $this-> VerifyReferer();
        $this-> SetTimeLimit();
        $this-> CheckUpload();
    }




    /*******************************************************************************************
								METHODES A USAGE INTERNE										
	********************************************************************************************/

    /**
     * M�thode lan�ant les v�rifications sur les fichiers. Initialisation de la variable $UploadError � true si erreur, lance la
     * m�thode d'�criture toutes les v�rifications sont ok.
     * @access private
     */
    function CheckUpload() {
        global $UploadError;

        // Parcours des fichiers � uploader
        for ($i=0; $i < count($_FILES['userfile']['tmp_name']); $i++) {

            // R�cup des propri�t�s
            $this-> _field = $i+1;                                // position du champ dans le formulaire � partir de 1 (0 �tant r�serv� au champ max_file_size)
            $this-> _size  = $_FILES['userfile']['size'][$i];     // poids du fichier
            $this-> _type  = $_FILES['userfile']['type'][$i];     // type mime
            $this-> _name  = $_FILES['userfile']['name'][$i];     // nom du fichier
            $this-> _temp  = $_FILES['userfile']['tmp_name'][$i]; // emplacement temporaire
            $this-> _ext   = strtolower(substr($this-> _name, strrpos($this-> _name, '.'))); // extension du fichier

            // On ex�cute les v�rifications demand�es
            if (is_uploaded_file($_FILES['userfile']['tmp_name'][$i])) {
                $this-> CheckSecurity();
                $this-> CheckMimeType();
                $this-> CheckExtension();
                $this-> CheckImg();
            } else $this-> AddError($_FILES['userfile']['error'][$i]); // Le fichier n'a pas �t� upload�, on r�cup�re l'erreur

            // Si le fichier a pass� toutes les v�rifications, on proc�de � l'upload, sinon on positionne la variable globale UploadError � 'true'
            if (!isset($this-> ArrOfError[$this-> _field])) $this-> WriteFile($this-> _name, $this-> _type, $this-> _temp, $this-> _size, $this-> _ext, $this-> _field);
            else $UploadError = true;
        }
    }



    /**
     * Ecrit le fichier sur le serveur.
     *
     * @access private
     * @param string $name        nom du fichier sans son extension
     * @param string $type        entete du fichier
     * @param string $temp        chemin du fichier temporaire
     * @param string $size        taille du fichier en octets
     * @param string $temp        extension du fichier pr�c�d�e d'un point
     * @param string $temp        extension du fichier pr�c�d�e d'un point
     * @param string $num_fied    position du champ dans le formulaire � compter de 1
     * @return bool               true/false => succes/erreur
     */
    function WriteFile($name, $type, $temp, $size, $ext, $num_field) {

        $new_filename = NULL;

        if (is_uploaded_file($temp)) {

            // Nettoyage du nom original du fichier
            if (Empty($this-> Filename)) $new_filename = $this-> CleanStr(substr($name, 0, strrpos($name, '.')));
            else $new_filename = $this-> Filename;

            // Ajout pr�fixes / suffixes + extension :
            $new_filename = $this-> Prefixe . $new_filename . $this-> Suffixe . $ext;

            switch ($this-> WriteMode) {
                // Si le fichier existe, on �crase
                case 0 : $uploaded = move_uploaded_file($temp, $this-> DirUpload . $new_filename);
                    break;

                // Si le fichier existe, on en fait une copie
                case 1 : if ($this-> AlreadyExist($new_filename)) $new_filename = 'copie_de_' . $new_filename;
                    $uploaded = move_uploaded_file($temp, $this-> DirUpload . $new_filename);
                    break;

                // Si le fichier existe, on ne fait rien
                case 2 :  if ($this-> AlreadyExist($new_filename)) $uploaded = true;
                    else $uploaded = move_uploaded_file($temp, $this-> DirUpload . $new_filename);
                    break;
            }

            // Informations pouvant �tre utiles au d�veloppeur (si le fichier a pu �tre copi�)
            if ($uploaded != false) {
                $this-> Infos[$num_field]['nom']          = $new_filename;
                $this-> Infos[$num_field]['nom_originel'] = $name;
                $this-> Infos[$num_field]['chemin']       = $this-> DirUpload . $new_filename;
                $this-> Infos[$num_field]['poids']        = number_format(filesize($this-> DirUpload . $new_filename)/1024, 3, '.', '');
                $this-> Infos[$num_field]['mime-type']    = $type;
                $this-> Infos[$num_field]['extension']    = $ext;
            }

            return true;
        }// End is_uploaded_file

        return false;
    } // End function



    /**
     * V�rifie si le fichier pass� en param�tre existe d�j� dans le r�pertoire DirUpload
     * @access private
     * @return bool
     */
    function AlreadyExist($file) {
        if (!file_exists($this-> DirUpload . $file)) return false;
        else return true;
    }



    /**
     * V�rifie la hauteur/largeur d'une image
     * @access private
     * @return bool
     */
    function CheckImg() {
        // V�rification de la largeur puis de la hauteur
        if ($taille = @getimagesize($this-> _temp) ) {
            if (!Empty($this-> ImgMaxWidth)  && $taille[0] > $this-> ImgMaxWidth)  $this-> AddError(8);
            if (!Empty($this-> ImgMaxHeight) && $taille[1] > $this-> ImgMaxHeight) $this-> AddError(9);
            if (!Empty($this-> ImgMinWidth)  && $taille[0] < $this-> ImgMinWidth) $this-> AddError(10);
            if (!Empty($this-> ImgMinHeight) && $taille[1] < $this-> ImgMinHeight) $this-> AddError(11);
        }

        return true;
    }



    /**
     * V�rifie l'extension des fichiers suivant celles pr�cis�es dans $Extension
     * @access private
     * @return bool
     */
    function CheckExtension() {
        $ArrOfExtension = explode(';', strtolower($this-> Extension));

        if (!Empty($this-> Extension) && !in_array($this-> _ext, $ArrOfExtension)) {
            $this-> AddError(7);
            return false;
        }

        return true;
    }



    /**
     * V�rifie l'ent�te des fichiers suivant ceux pr�cis�s dans $MimeType
     * @access private
     * @return bool
     */
    function CheckMimeType() {
        $ArrOfMimeType = explode(';', $this-> MimeType);

        if (!Empty($this-> MimeType) && !in_array($this-> _type, $ArrOfMimeType)) {
            $this-> AddError(6);
            return false;
        }

        return true;
    }



    /**
     * Ajoute une erreur pour le fichier sp�cifi� dans le tableau des erreur
     * @access private
     */
    function AddError($code_erreur) {

        // Le tableau des erreurs est de la forme :$arr[position_du_champ][code_erreur] = 'description';

        switch ($code_erreur) {
            case 1 : $msg = 'Le fichier � charger exc�de la directive upload_max_filesize (php.ini) ('. $this-> _name .')';
                break;

            case 2 : $msg = 'Le fichier exc�de la directive MAX_FILE_SIZE qui a �t� sp�cifi�e dans le formulaire ('. $this-> _name .')';
                break;

            case 3 : $msg = 'Le fichier n\'a pu �tre charg� compl�tement ('. $this-> _name .')';
                break;

            case 4 : $msg = 'Le champ du formulaire est vide';
                break;

            case 5 : $msg = 'Fichier potentiellement dangereux ('. $this-> _name .')';
                break;

            case 6 : $msg = 'Le fichier n\'est pas conforme � la liste des ent�tes autoris�s ('. $this-> _name .')';
                break;

            case 7 : $msg = 'Le fichier n\'est pas conforme � la liste des extensions autoris�es ('. $this-> _name .')';
                break;

            case 8 : $msg = 'La largeur de l\'image d�passe celle autoris�e ('. $this-> _name .')';
                break;

            case 9 : $msg = 'La hauteur de l\'image d�passe celle autoris�e ('. $this-> _name .')';
                break;

            case 10 : $msg = 'La largeur de l\'image est inf�rieure � celle autoris�e ('. $this-> _name .')';
                break;

            case 11 : $msg = 'La hauteur de l\'image est inf�rieure � celle autoris�e ('. $this-> _name .')';
                break;
        }


        if ($this-> Required && $code_erreur == 4) $this-> ArrOfError[$this-> _field][$code_erreur] = $msg;
        else if ($code_erreur != 4)                $this-> ArrOfError[$this-> _field][$code_erreur] = $msg;
    }


    /**
     * V�rifie les crit�res de la politique de s�curit�
     * @access private
     * @return bool
     */
    function CheckSecurity() {
        // Bloque tous les fichiers executables, et tous les fichiers php pouvant �tre interpr�t� mais dont l'ent�te ne peut les identifier comme �tant dangereux
        if ($this-> SecurityMax===true) {
            // Note : is_executable ne fonctionne pas => ?
            if (ereg ('application/octet-stream', $this-> _type) || preg_match("/.php$|.inc$|.php3$/i", $this-> _ext) ) {
                $this-> AddError(5);
                return false;
            }
        }

        return true;
    }



    /**
     * V�rifie et formate le chemin de destination :
     *     - d�finit comme rep par d�faut celui de la classe
     *     - teste l'existance du r�pertoire et son acc�s en �criture
     * @access private
     */
    function CheckDirUpload() {
        // Si aucun r�pertoire n'a �t� pr�cis�, on prend celui de la classe
        if (Empty($this-> DirUpload)) $this-> DirUpload = dirname(__FILE__);

        $this-> DirUpload = $this-> FormatDir($this-> DirUpload);

        // Le r�pertoire existe?
        if (!is_dir($this-> DirUpload)) $this-> Error('Le r�pertoire de destination sp�cifi�e par la propri�t� DirUpload n\'existe pas.');
        // Droit en �criture ?
        if (!is_writeable($this-> DirUpload)) $this-> Error('Le r�pertoire de destination sp�cifi�e par la propri�t� DirUpload est inaccessible en �criture.');
    }



    /**
     * Formate le r�pertoire pass� en param�tre
     *     - convertit un chemin relatif en chemin absolu
     *     - ajoute si besoin le dernier slash (ou antislash suivant le syst�me)
     * @access private
     */
    function FormatDir($Dir) {
        // Convertit les chemins relatifs en chemins absolus
        if (function_exists('realpath')) {
            if (realpath($Dir)) $Dir = realpath($Dir);
        }

        // Position du dernier slash/antislash
        if ($Dir[strlen($Dir)-1] != DIRECTORY_SEPARATOR) $Dir .= DIRECTORY_SEPARATOR;

        return $Dir;
    }



    /**
     * Formate la chaine pass�e en param�tre en nom de fichier standard (pas de caract�res sp�ciaux ni d'espaces)
     * @access private
     * @param  string $str   chaine � formater
     * @return string        chaine format�e
     */
    function CleanStr($str) {
        $return = '';

        for ($i=0; $i <= strlen($str)-1; $i++) {
            if (eregi('[a-z]',$str{$i}))              $return .= $str{$i};
            elseif (eregi('[0-9]', $str{$i}))         $return .= $str{$i};
            elseif (ereg('[������������]', $str{$i})) $return .= 'a';
            elseif (ereg('[��]', $str{$i}))           $return .= 'a';
            elseif (ereg('[��]', $str{$i}))           $return .= 'c';
            elseif (ereg('[��������E]', $str{$i}))    $return .= 'e';
            elseif (ereg('[��������]', $str{$i}))     $return .= 'i';
            elseif (ereg('[����������]', $str{$i}))   $return .= 'o';
            elseif (ereg('[��������]', $str{$i}))     $return .= 'u';
            elseif (ereg('[��ݟ]', $str{$i}))         $return .= 'y';
            elseif (ereg('[ ]', $str{$i}))            $return .= '_';
            elseif (ereg('[.]', $str{$i}))            $return .= '_';
            else                                      $return .= $str{$i};
        }

        return $return;
    }



    /**
     * V�rifie que la provenance du formulaire est bien celle pr�cis�e dans la propri�t�e CheckReferer.
     * @access private
     * @return bool
     */
    function VerifyReferer() {
        if (!Empty($this-> CheckReferer)) {
            $headerref = $_SERVER['HTTP_REFERER'];

            // On enl�ve toutes les variables pass�es par url
            if (ereg("\?",$headerref)) {
                list($url, $getstuff) = split('\?', $headerref);
                $headerref = $url;
            }

            if ($headerref == $this-> CheckReferer) return true;
            else $this-> Error('Acc�s refus�');
        }
    }



    /**
     * Initialise si possible le temps d'ex�cution max du script en fonction du nombre de fichiers et de la propri�t� max_file_size
     * @access private
     */
    function SetTimeLimit() {
        // Le temps calcul� est th�oriquement le plus rapide => * 2
        if(function_exists('set_time_limit')) {
            @set_time_limit(ceil(ceil($this->  $_POST['MAX_FILE_SIZE'] * 8) / ($this-> Debit * 1000) * count($_FILES) * 2));
        }
    }



    /**
     * Conversion du poids maximum d'un fichier exprim�e en Ko en octets
     * @access private
     */
    function SetMaxFilesize() {
        (is_numeric($this-> MaxFilesize)) ? $this-> MaxFilesize = $this-> MaxFilesize * 1024 : $this-> Error('la propri�t� MaxFilesize doit �tre une valeur num�rique');
    }



    /**
     * Cr�e les champs de type fichier suivant la propri�t� Fields dans un tableau $Field. Ajoute le contenu de FieldOptions aux champs.
     * @access private
     */
    function CreateFields() {
        if (!is_int($this-> Fields)) $this-> Error('la propri�t� Fields doit �tre un entier');

        for ($i=0; $i <= $this-> Fields; $i++) {
            if ($i == 0)  $this-> Field[] = '<input type="hidden" name="MAX_FILE_SIZE" value="'. $this-> MaxFilesize .'"/>';
            else          $this-> Field[] = '<input type="file" name="userfile[]" '. $this-> FieldOptions .'/>';
        }
    }



    /**
     * V�rifie la configuration de la classe.
     * @access private
     */
    function CheckConfig() {
        if (!version_compare(phpversion(), '4.2.0')) $this-> Error('la version de php sur ce serveur est trop ancienne. La classe ne peut fonctionner qu\'avec une version �gale ou sup�rieure � la version 4.1.0');
        if (!is_string($this-> Extension)) $this-> Error('la propri�t� Extension est mal configur�e.');
        if (!is_string($this-> MimeType)) $this-> Error('la propri�t� MimeType est mal configur�e.');
        if (!is_string($this-> Filename)) $this-> Error('la propri�t� Filename est mal configur�e.');
        if (!is_numeric($this-> Debit)) $this-> Error('la propri�t� Debit est mal configur�e.');
        if (!is_bool($this-> Required)) $this-> Error('la propri�t� Required est mal configur�e.');
        if (!is_bool($this-> SecurityMax)) $this-> Error('la propri�t� SecurityMax est mal configur�e.');
        if ($this-> WriteMode != 0 && $this-> WriteMode != 1 && $this-> WriteMode != 2) $this-> Error('la propri�t� WriteMode est mal configur�e.');
        if (!Empty($this-> CheckReferer) && !@fopen($this-> CheckReferer, 'r')) $this-> Error('la propri�t� CheckReferer est mal configur�e.');
        $this-> CheckImgPossibility();
        $this-> CheckDirUpload();
    }



    /**
     * V�rifie les propri�t�s ImgMaxWidth/ImgMaxHeight
     * @access private
     */
    function CheckImgPossibility() {
        if (!Empty($this-> ImgMaxWidth)  && !is_numeric($this-> ImgMaxWidth))   $this-> Error('la propri�t� ImgMaxWidth est mal configur�e.');
        if (!Empty($this-> ImgMaxHeight) && !is_numeric($this-> ImgMaxHeight))  $this-> Error('la propri�t� ImgMaxHeight est mal configur�e.');
        if (!Empty($this-> ImgMinWidth)  && !is_numeric($this-> ImgMinWidth))   $this-> Error('la propri�t� ImgMinWidth est mal configur�e.');
        if (!Empty($this-> ImgMinHeight) && !is_numeric($this-> ImgMinHeight))  $this-> Error('la propri�t� ImgMinHeight est mal configur�e.');
    }



    /**
     * Affiche les erreurs de configuration et stoppe tout traitement
     * @access private
     */
    function Error($error_msg) {
        if ($this-> TrackError) {
            echo 'Erreur classe Upload : ' . $error_msg;
            exit;
        }
    }

} // End Class
?>