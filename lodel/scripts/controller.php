<?php
/**
 * Fichier de la classe Controller
 *
 * PHP 5
 *
 * LODEL - Logiciel d'Edition ELectronique.
 *
 * Copyright (c) 2001-2002, Ghislain Picard, Marin Dacos
 * Copyright (c) 2003, Ghislain Picard, Marin Dacos, Luc Santeramo, Nicolas Nutten, Anne Gentil-Beccot
 * Copyright (c) 2004, Ghislain Picard, Marin Dacos, Luc Santeramo, Anne Gentil-Beccot, Bruno C�nou
 * Copyright (c) 2005, Ghislain Picard, Marin Dacos, Luc Santeramo, Gautier Poupeau, Jean Lamy, Bruno C�nou
 * Copyright (c) 2006, Marin Dacos, Luc Santeramo, Bruno C�nou, Jean Lamy, Mika�l Cixous, Sophie Malafosse
 * Copyright (c) 2007, Marin Dacos, Bruno C�nou, Sophie Malafosse, Pierre-Alain Mignot
 * Copyright (c) 2008, Marin Dacos, Bruno C�nou, Pierre-Alain Mignot, In�s Secondat de Montesquieu, Jean-Fran�ois Rivi�re
 * Copyright (c) 2009, Marin Dacos, Bruno C�nou, Pierre-Alain Mignot, In�s Secondat de Montesquieu, Jean-Fran�ois Rivi�re
 *
 * Home page: http://www.lodel.org
 *
 * E-Mail: lodel@lodel.org
 *
 * All Rights Reserved
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 *
 * @author Ghislain Picard
 * @author Jean Lamy
 * @author Pierre-Alain Mignot
 * @copyright 2001-2002, Ghislain Picard, Marin Dacos
 * @copyright 2003, Ghislain Picard, Marin Dacos, Luc Santeramo, Nicolas Nutten, Anne Gentil-Beccot
 * @copyright 2004, Ghislain Picard, Marin Dacos, Luc Santeramo, Anne Gentil-Beccot, Bruno C�nou
 * @copyright 2005, Ghislain Picard, Marin Dacos, Luc Santeramo, Gautier Poupeau, Jean Lamy, Bruno C�nou
 * @copyright 2006, Marin Dacos, Luc Santeramo, Bruno C�nou, Jean Lamy, Mika�l Cixous, Sophie Malafosse
 * @copyright 2007, Marin Dacos, Bruno C�nou, Sophie Malafosse, Pierre-Alain Mignot
 * @copyright 2008, Marin Dacos, Bruno C�nou, Pierre-Alain Mignot, In�s Secondat de Montesquieu, Jean-Fran�ois Rivi�re
 * @copyright 2009, Marin Dacos, Bruno C�nou, Pierre-Alain Mignot, In�s Secondat de Montesquieu, Jean-Fran�ois Rivi�re
 * @licence http://www.gnu.org/copyleft/gpl.html
 * @since Fichier ajout� depuis la version 0.8
 * @version CVS:$Id$
 */

// {{{ class
/**
 * Classe g�rant la partie contr�leur du mod�le MVC utilis� par Lodel 0.8
 * 
 * 
 *
 * @package lodel
 * @author Ghislain Picard
 * @author Jean Lamy
 * @author Pierre-Alain Mignot
 * @copyright 2001-2002, Ghislain Picard, Marin Dacos
 * @copyright 2003, Ghislain Picard, Marin Dacos, Luc Santeramo, Nicolas Nutten, Anne Gentil-Beccot
 * @copyright 2004, Ghislain Picard, Marin Dacos, Luc Santeramo, Anne Gentil-Beccot, Bruno C�nou
 * @copyright 2005, Ghislain Picard, Marin Dacos, Luc Santeramo, Gautier Poupeau, Jean Lamy, Bruno C�nou
 * @copyright 2006, Marin Dacos, Luc Santeramo, Bruno C�nou, Jean Lamy, Mika�l Cixous, Sophie Malafosse
 * @copyright 2007, Marin Dacos, Bruno C�nou, Sophie Malafosse, Pierre-Alain Mignot
 * @copyright 2008, Marin Dacos, Bruno C�nou, Pierre-Alain Mignot, In�s Secondat de Montesquieu, Jean-Fran�ois Rivi�re
 * @copyright 2009, Marin Dacos, Bruno C�nou, Pierre-Alain Mignot, In�s Secondat de Montesquieu, Jean-Fran�ois Rivi�re
 * @licence http://www.gnu.org/copyleft/gpl.html
 * @since Fichier ajout� depuis la version 0.8
 * @see logic.php
 * @see view.php
 */
class Controller 
{
	/**
	 * @var object
	 */
	static private $_instance;

	/**
	 * Constructeur de la classe Controller.
	 *
	 * Ce constructeur se charge du nettoyage des variables $_POST, $_GET dans un premier temps. Puis
	 * suivant la logique appel�e et l'action demand�e il se charge d'appeler la bonne logique m�tier.
	 * Enfin, suivant le r�sultat de cet appel il appelle vue correspondante.
	 *
	 *
	 * exemple :
	 * <code>
	 * <?php
	 * $lo = "entities";
	 * Controller::getController()->execute(array("entities","entities_advanced","entities_edition",
	 * "entities_import", "entities_index", "filebrowser", "tasks","xml"),$lo);
	 * ?>
	 * </code>
	 *
	 * @param array $logics Les logiques m�tiers accept�es par le point d'entr�e
	 * @param string $lo La logique m�tier appel�e. Par d�faut cette valeur est vide
	 * @param array $request La requ�te � traiter, si elle n'est pass�e ni en GET ni en POST (dans un script par ex.) : utilis� pour l'import massif de XML
	 * 
	 */
	private function __construct()
	{
        	if(!defined('INC_FUNC')) include 'func.php'; // include needed funcs
    	}

	/**
	 * Just return the instance when cloning
	 */
	public function __clone()
	{
		return Controller::getController();
	}

	/**
	 * Singleton
	 * Will instantiate the class if not already done
	 */
	static public function getController()
	{
		if(!isset(self::$_instance))
		{
			$c = __CLASS__;
			self::$_instance = new $c;
		}
		
		return self::$_instance;
	}

	/**
	 * Front door of the controller.
	 * Will either execute the given action, try to authenticate a restricted user or display an entity
	 *
	 * @param array $logics allowed logics list
	 * @param string $lo name of the logic to call
	 * @param array $request a request, if called by a script
	 */
	public function execute($logics, $lo = null, $request = null)
	{
		$isInternal = false;
		// if the request comes from a script
		if(isset($request))
		{
			$isInternal = true;
			C::setRequest($request, true);
		}
		
		$context =& C::getC();
	
		if(empty($context['do']) && $isInternal)
			trigger_error('ERROR: you need to specify an action', E_USER_ERROR);
	
		if ($isInternal || !empty($context['do'])) 
		{
			$do = $context['do'].'Action';
			if ($do == 'backAction') 
			{
				View::getView()->back(2); //revient 2 rang en arri�re dans l'historique.
				return;
			}
		
			if(!isset($lo)) $lo = C::get('lo');
			if ($lo != 'texts' && !in_array($lo, $logics)) {
				trigger_error("ERROR: unknown logic", E_USER_ERROR);
			}
	
			$error = null;
			$context['error'] = array();
			$ret = $this->_execute($context, $do, $lo, $logics, $error);
			$context['error'] = array_merge((array)$context['error'], (array)$error);

			if (!$ret) 
				trigger_error('ERROR: invalid return from the logic.', E_USER_ERROR);
	
			if($do != 'listAction') C::trigger('postedit');

			if(!empty($context['error']) && $ret != '_error')
			{ // maybe an error from plugins
				$ret = '_error';
			}
		
			if($isInternal)
			{
				if($ret == '_error' && !$error)
				{
				// strange, what to do ????
				}
				
				$ret = '_next';
			}
		
			//Appel de la vue n�cessaire
			switch($ret) {
				case '_next' : 
					// controller called by a script
					C::reset();
					return ($error ? $error : '_next');
				break;

				case '_back' :
					View::getView()->back();
				break;

				case '_error' :
					// hum... needs to remove the slashes... don't really like that, because some value may still 
					// come from  database or lodel. Doing this way is not a security issue but may forbide
					// user to use \' in there text
					#require_once 'func.php';
					mystripslashes($context);
					C::trigger('preview');
					if(false !== ($p = strpos($do, '_')))
					{ // plugin call
						getLogic($lo)->factory($context, $error, substr($do, 0, $p).'_viewAction');
					}
					else getLogic($lo)->viewAction($context, $error); // in case anything is needed to be put in the context
					$context['error'] = array_merge((array)$context['error'], (array)$error);
				case '_ok' :
					View::getView()->render(($do != 'listAction' ? "edit_" : "") . $lo);
				break;

				default:
					if (strpos($ret, '_location:') === 0) {
						header(substr($ret, 1));
						exit;
					}
					C::trigger('preview');
					View::getView()->renderCached($ret);
				break;
			}
			exit;
		} 
		elseif(isset($context['file'])) 
		{
			// appel d'un docannexe
			$this->_getAnnexe($context);
		}
		elseif (!C::get('id', 'lodeluser') && isset($context['login'])) 
		{ // restricted area, only if we are not already logged in
			$this->_auth($context);
		} 
		
		$context['identifier'] = C::get('identifier');
		// ID ou IDENTIFIER
		if ($context['id'] || $context['identifier']) 
		{
			if(!defined('INC_CONNECT')) include 'connect.php'; // init DB if not already done
			global $db;
			do { // exception block
				if ($context['id']) 
				{
					$class = $db->CacheGetOne(lq("SELECT class FROM #_TP_objects WHERE id='{$context['id']}'"));
					if ($db->errorno() && C::get('rights', 'lodeluser') > LEVEL_VISITOR) {
						trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
					}
					if (!$class) { 
						header("HTTP/1.0 404 Not Found");
						header("Status: 404 Not Found");
						header("Connection: Close");
						if(file_exists(C::get('home', 'cfg')."../../missing.html")) {
						include C::get('home', 'cfg')."../../missing.html";
						} else {
						header('Location: not-found.html');
						}
						exit; 
					}
				} 
				elseif ($context['identifier']) 
				{
					$class = 'entities';
				} 
				else trigger_error("?? strange", E_USER_ERROR);
				
				switch($class) {
					case 'entities':
					$this->_printEntities($context['id'], $context['identifier'], $context);
					break;

					case 'entrytypes':
					case 'persontypes':
					$result = $db->execute(lq("SELECT * FROM #_TP_{$class} WHERE id='{$context['id']}' AND status>0")) 
						or trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
					$context['type'] = $result->fields;
					View::getView()->renderCached($result->fields['tplindex']);
					exit;

					case 'persons':
					case 'entries':
					$this->_printIndex($context['id'], $class, $context);
					break;
				} // switch class
			} while(0);
			//PAGE
		} elseif (isset($context['page'])) { // call a special page (and template)
			if (strlen($context['page']) > 64 || preg_match("/[^a-zA-Z0-9_\/-]/", $context['page'])) {
				trigger_error('invalid page', E_USER_ERROR);
			}
			View::getView()->renderCached($context['page']);
			exit;
		} else {
			//tente de r�cup�rer le path - parse la query string pour trouver l'entit�
			$query = preg_replace("/[&?](format|clearcache)=\w+/", '', $_SERVER['QUERY_STRING']);
			
			if($query && !preg_match("/[^a-zA-Z0-9_\/-]/", $query)) {
				// maybe a path to the document
				$path = preg_split("#/#", $query, -1, PREG_SPLIT_NO_EMPTY);
				$entity = end($path);
				$id = (int)$entity;
				if ($id) {
					$this->_printEntities($id, '', $context);
				}
			} else {
				// rien � faire.
			}
		}
		View::getView()->renderCached('index');
	} // constructor }}}
	
	/**
	 * Try to add an object which is NOT an entity
	 *
	 * @param string $type the type of the object to remove
	 * @param array $request the request passed by reference
	 */
	static public function addObject($type, array &$request)
	{
		global $db;
		$authorizedTypes = array(
			'tablefields',
			'tablefieldgroups',
			'types',
			'classes',
			'entrytypes',
			'persontypes',
			'characterstyles',
			'internalstyles',
			'options',
			'optiongroups',
			'texts',
			'translations',
			'indextablefields'
			);
		
		// for other sensible types, better way is to call Controller::execute
		if(!in_array($type, $authorizedTypes)) 
			trigger_error('ERROR: invalid type of object, please use Controller::execute instead', E_USER_ERROR);
		
		$request['do'] = 'edit';
		$request['lo']= $type;
		$request['creationmethod'] = 'Lodel::Controller::addObject';
		$request['edit'] = 1;
		$request['status'] = 1;
		$request['protected'] = 1;
		
		$where = array();
		$uniqueFields = getLogic($type)->getUniqueFields();
		foreach($uniqueFields[0] as $field)
		{
			if(!isset($request[$field]))
			{
				return 'ERROR: missing field '.$field;
			}
			$where[] = $field.'='.$db->quote($request[$field]);
		}
		$vo = getDAO($type)->find(join(' AND ', $where), 'id');
		unset($where);
		
		$request['id'] = $vo ? $vo->id : 0;
		
		$ret = Controller::getController()->execute(array($type), $type, $request);
		if('_next' !== $ret)
		{
			return $ret;
		}
		return true;
	}

	/**
	 * Try to remove an object which is NOT an entity
	 *
	 * @param string $type the type of the object to remove
	 * @param array $request the request passed by reference
	 */	
	static public function removeObject($type, array &$request)
	{
		if(!isset($request['id']) || !($request['id'] = (int)$request['id']))
			trigger_error('ERROR: a valid id is needed', E_USER_ERROR);

		$authorizedTypes = array(
			'tablefields',
			'tablefieldgroups',
			'types',
			'classes',
			'entrytypes',
			'persontypes',
			'characterstyles',
			'internalstyles',
			'options',
			'optiongroups',
			'texts',
			'translations',
			'indextablefields'
			);
		
		// for other sensible types, better way is to call Controller::execute
		if(!in_array($type, $authorizedTypes)) 
			trigger_error('ERROR: invalid type of object, please use Controller::execute instead', E_USER_ERROR);
		
		$request['do'] = 'delete';
		$request['lo']= $type;
		
		$ret = Controller::getController()->execute(array($type), $type, $request);
		if('_next' !== $ret)
		{
			return $ret;
		}
		return true;
	}
	
	/**
	 * Will try to authenticate the user.
	 * Warning : here we only manage restricted users !
	 *
	 * @param array $context the context passed by reference
	 */
	private function _auth(&$context)
	{
		if(!defined('INC_CONNECT')) include 'connect.php'; // init DB if not already done
		global $db;
		if(!function_exists('check_auth_restricted'))
			include 'loginfunc.php';
		do {
			if (!check_auth_restricted($context['login'], $context['passwd'], C::get('site', 'cfg'))) {
				$context['error_login'] = $err = 1;
				C::setUser();
				break;
			}
		
			//v�rifie que le compte n'est pas en suspend. Si c'est le cas, on am�ne l'utilisateur � modifier son mdp, sinon on l'identifie
			if(!check_expiration()) {
				$context['error_expiration'] = $err = 1;
				C::setUser();
				break;
			} else {
				// ouvre une session
				$err = open_session($context['login']);
				if (!$err || $err == 'error_opensession') {
					$context[$err] = $err = 1;
					C::setUser();
					break;
				}
			}
		} while (0);

		$context['passwd'] = 0;
		if($err) // une erreur : besoin de l'afficher, donc pas d'utilisation du cache
			$context['nocache'] = true;
	}
	
	/**
	 * Will try to get a docannexe and send it to the browser to download
	 *
	 * @param array $context the context passed by reference
	 */
	private function _getAnnexe(&$context)
	{
		if(!defined('INC_CONNECT')) include 'connect.php'; // init DB if not already done
		global $db;
		$critere = C::get('rights', 'lodeluser') > LEVEL_VISITOR ? '' : 
		" AND {$GLOBALS['tableprefix']}entities.status>0 AND {$GLOBALS['tableprefix']}types.status>0";
		
		$row = $db->getRow("
		SELECT {$GLOBALS['tp']}tablefields.name, {$GLOBALS['tp']}tablefields.class 
			FROM {$GLOBALS['tp']}tablefields, 
			{$GLOBALS['tp']}entities LEFT JOIN {$GLOBALS['tp']}types ON ({$GLOBALS['tp']}entities.idtype = {$GLOBALS['tp']}types.id) 
			WHERE {$GLOBALS['tp']}entities.id='{$context['id']}' AND {$GLOBALS['tp']}tablefields.class = {$GLOBALS['tp']}types.class 
			AND {$GLOBALS['tp']}tablefields.type = 'file'{$critere} ORDER BY tablefields.id");
		if($row) 
		{
			$datepubli = $db->getRow("
			SELECT name 
				FROM {$GLOBALS['tableprefix']}tablefields 
				WHERE class = '{$row['class']}' AND name = 'datepubli'");
			
			if(!$datepubli) 
			{
				$file = $db->getRow("SELECT {$row['name']} FROM {$GLOBALS['tableprefix']}{$row['class']} WHERE identity = '{$context['id']}'");
				if($file[$row['name']]) {
				download($file[$row['name']]);
				exit();
				}
			} 
			else 
			{
				$datepubli = $db->getRow("SELECT datepubli FROM {$GLOBALS['tableprefix']}{$row['class']} WHERE identity = '{$context['id']}'");
				$datepubli = $datepubli['datepubli'];
		
				if(!defined('INC_TEXTFUNC')) include 'textfunc.php';
				
				if(!$datepubli || $datepubli <= today() || C::get('rights', 'lodeluser') >= LEVEL_RESTRICTEDUSER) 
				{
					$file = $db->getRow("SELECT {$row['name']} FROM {$GLOBALS['tableprefix']}{$row['class']} WHERE identity = '{$context['id']}'");
					if($file[$row['name']]) 
					{
						download($file[$row['name']]);
						exit();
					}
				}
			}
		}
		return false;
	}
	
	/**
	 * Execute the given action and call the trigger preedit
	 *
	 * @param array $context the context by reference
	 * @param string $do the action to execute
	 * @param string $lo the logic to call
	 * @param array $logics the authorized logics
	 * @param array $error errors, passed by reference
	 */
	private function _execute(&$context, $do, $lo, $logics, &$error)
	{
		if(!defined('INC_CONNECT')) include 'connect.php'; // init DB if not already done
		global $db;
		
		if(!function_exists('getLogic')) include 'logic.php';
	
		// que fait-on suivant l'action demand�e
		switch($do) 
		{
			case 'listAction' :
				recordurl(); //enregistre l'url dans la pile
			#case 'viewAction' :
				#recordurl();
			default:
				if($do != 'listAction') C::trigger('preedit');
				
				if(!empty($context['error'])) return '_error';
				
				$logic = getLogic($lo);
				// create the logic for the table
				if (!method_exists($logic, $do)) 
				{
					if ('listAction' == $do) 
					{
						return '_ok';
					} 
					elseif('plugins' == $lo) 
					{
						return $logic->factory($context, $error, $do);
					} 
					else 
					{
						trigger_error('ERROR: invalid action', E_USER_ERROR);
					}
				} 
				else 
				{
					// call the logic action
					return $logic->$do($context, $error);
				}
			break;
		}
	}

	/**
	* Affichage d'une entit�
	*
	* Affiche une entit� gr�ce � son id, son identifiant. Appelle la vue associ�e
	*
    	* @param integer $id identifiant num�rique de l'index
	* @param string $identifier 
   	 * @param array &$context le context par r�f�rence
	*/
	private function _printEntities($id, $identifier, &$context)
	{
		if(!defined('INC_CONNECT')) include 'connect.php'; // init DB if not already done
		global $db;
		$context['classtype'] = 'entities';
		$critere = C::get('visitor', 'lodeluser') ? 'AND #_TP_entities.status>-64' : 'AND #_TP_entities.status>0 AND #_TP_types.status>0';
		
        	// cherche le document, et le template
		do {
			if ($identifier) {
				$identifier = addslashes(stripslashes(substr($identifier, 0, 255)));
				$where = "#_TP_entities.identifier='". $identifier. "' ". $critere;
			} else {
				$where = "#_TP_entities.id='". $id. "' ". $critere;
			}
			$row = $db->getRow(lq("SELECT #_TP_entities.*,tpl,type,class FROM #_entitiestypesjoin_ WHERE ". $where));
			if ($row === false) {
				trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
			}
			if (!$row) { 
				header("HTTP/1.0 404 Not Found");
				header("Status: 404 Not Found");
				header("Connection: Close");
				if(file_exists(C::get('home', 'cfg')."../../missing.html")) {
					include C::get('home', 'cfg')."../../missing.html";
				} else {
					header('Location: not-found.html');
				}
				exit; 
			}
			$base = $row['tpl']; // le template � utiliser pour l'affichage
			if (!$base) { 
				$id = $row['idparent'];
				$relocation = TRUE;
			}
		} while (!$base && !$identifier && $id); 
	
		if (isset($relocation)) { 
			header('location: '. makeurlwithid('index', $row['id']));
			exit;
		}
		$context = array_merge($context, $row);
		$row = $db->getRow(lq("SELECT * FROM #_TP_". $row['class']. " WHERE identity='". $row['id']. "'"));
		if ($row === false) {
			trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
		}
		if (!$row) {
			header("HTTP/1.0 404 Not Found");
			header("Status: 404 Not Found");
			header("Connection: Close");
			if(file_exists(C::get('home', 'cfg')."../../missing.html")) {
				include C::get('home', 'cfg')."../../missing.html";
			} else {
				header('Location: not-found.html');
			}
			exit; 
		}

		if(!function_exists('merge_and_filter_fields'))
			include 'filterfunc.php';

		//Merge $row et applique les filtres d�finis dans le ME
		merge_and_filter_fields($context, $context['class'], $row);
		getgenericfields($context); // met les champs g�n�riques de l'entit� dans le contexte
		View::getView()->renderCached($base);
		exit;
	}

	/**
	* Affichage d'un objet de type index
	*
	* @param integer $id identifiant num�rique de l'index
	* @param string $classtype type de la classe
	* @param array &$context le context par r�f�rence
	*/
	private function _printIndex($id, $classtype, &$context)
	{
		if(!defined('INC_CONNECT')) include 'connect.php'; // init DB if not already done
		global $db;
		$context['classtype'] = $classtype;
		switch($classtype) {
		case 'persons':
			$typetable = '#_TP_persontypes';
			$table     = '#_TP_persons';
			$longid    = 'idperson';
			break;
		case 'entries':
			$typetable = '#_TP_entrytypes';
			$table     = '#_TP_entries';
			$longid    = 'identry';
			break;
		default:
			trigger_error('ERROR: internal error in printIndex', E_USER_ERROR);
		}
	
		// get the index
		$critere = C::get('visitor', 'lodeluser') ? 'AND status>-64' : 'AND status>0';
		$row = $db->getRow(lq("SELECT * FROM ". $table. " WHERE id='". $id. "' ". $critere));
		if ($row === false) {
			trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
		}
		if (!$row) {
			header("HTTP/1.0 404 Not Found");
			header("Status: 404 Not Found");
			header("Connection: Close");
			if(file_exists(C::get('home', 'cfg')."../../missing.html")) {
				include C::get('home', 'cfg')."../../missing.html";
			} else {
				header('Location: not-found.html');
			}
			exit;
		}
		$context = array_merge($context, $row);
		// get the type
		$row = $db->getRow(lq("SELECT * FROM ". $typetable. " WHERE id='". $row['idtype']. "'". $critere));
		if ($row === false) {
			trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
		}
		if (!$row) {
			header("HTTP/1.0 404 Not Found");
			header("Status: 404 Not Found");
			header("Connection: Close");
			if(file_exists(C::get('home', 'cfg')."../../missing.html")) {
				include C::get('home', 'cfg')."../../missing.html";
			} else {
				header('Location: not-found.html');
			}
			exit;
		}
		$base            = $row['tpl'];
		$context['type'] = $row;
	
		// get the associated table
		$row = $db->getRow(lq("SELECT * FROM #_TP_".$row['class']." WHERE ".$longid."='".$id."'"));
		if ($row === false) {
			trigger_error("SQL ERROR :<br />".$GLOBALS['db']->ErrorMsg(), E_USER_ERROR);
		}
		if (!$row) {
			trigger_error("ERROR: internal error", E_USER_ERROR);
		}

		if(!function_exists('merge_and_filter_fields'))
			include 'filterfunc.php';

		merge_and_filter_fields($context, $context['type']['class'], $row);
		View::getView()->renderCached($base);
		exit;
	}
} // }}}
?>