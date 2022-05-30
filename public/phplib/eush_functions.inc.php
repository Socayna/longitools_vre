<?php

//Get the actual user (the user logged in)
function getUser($userId) {
	//initiallize variables
        $response="{}";

        //fetch user
	$user = checkUserIDExists($userId);
        $response = json_encode($user, JSON_PRETTY_PRINT);
        return $response;
}


///////////////////////////////
// Querying EGA Metadata API // 
///////////////////////////////

function getEGADatasets($var){
	$response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API'].'/datasets?queryBy=file&queryId='.$var.'');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
	return $response;
}

function getEGADatasetsFromDSid($var){
	$response="{}";
        $curl = curl_init();             
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API_TEST'].'/datasets/'.$var.'?idType=EGA_STABLE_ID');
//        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API_TEST'].'/datasets/EGAD50000000045?idType=EGA_STABLE_ID');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
	return $response;
}
/*
function listEGAFilesFromDataset($ds_id){
	$response="{}";
        $curl = curl_init();             
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API_TEST'].'/files/'.$var.'?idType=EGA_STABLE_ID');
//        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API_TEST'].'/datasets/EGAD50000000045?idType=EGA_STABLE_ID');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
	return $response;
}*/

function getEGAFilesFromDSid($var){
	$response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API_TEST'].'/files?queryBy=dataset&queryId='.$var.'');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
	return $response;
}

function getEGAFiles($var){
	$response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EGA_METADATA_API'].'/files?queryBy=dataset&queryId='.$var.'');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
	return $response;
}

///////////////////////////////
//     Querying XNAT  API    // 
///////////////////////////////

// TODO: For next meeting demo we will show only 1 specific project. Marcel Koek recommendation.
function getEuroBioImagingProjects(){
	$response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://xnat.bmia.nl/data/archive/projects?format=json&accessible=true");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
	return $response;
}

function getEuroBioImagingSubjects($var){
        $response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects?format=json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        return $response;
}

function getEuroBioImagingExperiments($var, $var2){
        $response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects/'.$var2.'/experiments?format=json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        return $response;
}

function getEuroBioImagingExperimentsFormat($var, $var2, $var3){
        $response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects/'.$var2.'/experiments/'.$var3.'?format=json');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        return $response;
}

function getEuroBioImagingExperimentsFiles($var, $var2, $var3){
        $response="{}";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects/'.$var2.'/experiments/'.$var3.'/scans/ALL/files?format=zip');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
        $response = curl_exec($curl);
        curl_close($curl);
        file_put_contents("'$var'_'$var2'_'$var3'.zip", $response);
        //$response = json_encode($response);
        
        //return $response;
        return (filesize("'$var'_'$var2'_'$var3'.zip") > 0)? true : false;
}

// TODO: For next meeting demo we will show only 1 specific project. Marcel Koek recommendation.
function getEuroBioImagingAuthorizedProjects(){
	$response="{}";
        $curl = curl_init(); 
        $username = $_SESSION['User']['linked_accounts']['euBI']["alias"];
        $password = $_SESSION['User']['linked_accounts']['euBI']["secret"];
        curl_setopt($curl, CURLOPT_URL, "https://xnat.bmia.nl/data/archive/projects?format=json&collaborator=true&owner=true&member=true");
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
	$response = json_encode($response);
        curl_close($curl);

	return $response;
}


function getEuroBioImagingAuthorizedSubjects($var){
        $response="{}";
        $curl = curl_init();
        $username = $_SESSION['User']['linked_accounts']['euBI']["alias"];
        $password = $_SESSION['User']['linked_accounts']['euBI']["secret"];
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects?format=json');
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        return $response;
}

function getEuroBioImagingAuthorizedExperiments($var, $var2){
        $response="{}";
        $curl = curl_init();
        $username = $_SESSION['User']['linked_accounts']['euBI']["alias"];
        $password = $_SESSION['User']['linked_accounts']['euBI']["secret"];
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects/'.$var2.'/experiments?format=json');
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        return $response;
}

function getEuroBioImagingAuthorizedExperimentsFormat($var, $var2, $var3){
        $response="{}";
        $curl = curl_init();
        $username = $_SESSION['User']['linked_accounts']['euBI']["alias"];
        $password = $_SESSION['User']['linked_accounts']['euBI']["secret"];
        curl_setopt($curl, CURLOPT_URL, $GLOBALS['EUBI_XNAT_API'].'/data/archive/projects/'.$var.'/subjects/'.$var2.'/experiments/'.$var3.'?format=json');
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        $response = json_encode($response);
        curl_close($curl);
        return $response;
}

function is_valid_EuroBioImagingAliasToken($username=0,$password=0){

	#$response  = new JsonResponse();

	// Get token and secret
	if (!$username){
       		$username = $_SESSION['User']['linked_accounts']['euBI']["alias"];
	}
	if (!$password){
		$password = $_SESSION['User']['linked_accounts']['euBI']["secret"];
	}
	if (!$username || !$password){
		$msg  = "Cannot validate XNAT alias token. Invalid arguments. Make user 'Alias Token' is correctly set.";
		$code = 400;
		$_SESSION['errorData']['Error'][]=$msg;
		#$response->setCode($code);
                #$response->setMessage($msg);
                #return $response->getResponse();
		return false;
	}

	// Query XNAT API
	list($r,$info) = get($GLOBALS['EUBI_XNAT_API'].'/data/services/tokens/validate/'.$username.'/'.$password);
	if ($info['http_code'] !== 200){
		$msg  = "Cannot validate XNAT alias token. Invalid alias given.";
		$code = $info['http_code']; 
		$_SESSION['errorData']['Error'][]=$msg;
		#$response->setCode($code);
                #$response->setMessage($msg);
                #return $response->getResponse();
		return false;
	}

	// Evaludate response
	$response = json_decode($r,TRUE);
	if (isset($response['valid'])){
		return true;
	}else{
		return false;
	}
}

function createEuroBioImagingToken($username=0,$password=0){

	$response = new JsonResponse();

	// Get token and secret
	if (!$username){
       		$username = $_SESSION['User']['linked_accounts']['euBI']["alias"];
	}
	if (!$password){
		$password = $_SESSION['User']['linked_accounts']['euBI']["secret"];
	}

	// Query XNAT API
	list($r,$info) = get($GLOBALS['EUBI_XNAT_API'].'/data/services/tokens/issue',array(),array("user"=> $username,"pass"=>$password));
	if ($info['http_code'] !== 200){
		$msg  = "Cannot create a new alias token. Please, make sure current token ($username) is still valid.";
		$code = $info['http_code']; 
		$_SESSION['errorData']['Error'][]=$msg;
		$response->setCode($code);
                $response->setMessage($msg);
                return $response->getResponse();
	}
        $response->setBody($r);
        return $response->getResponse();
}

function addUserLinkedAccount_euBI($alias_token=0,$secret=0){
	
		// Check arguments

                if (!$alias_token || !$secret) {
			$_SESSION['errorData']['Error'][]="euro-BioImaging Alias Token not saved. Bad input parameters.";
			return false;
		}

		// Validate given alias_token

                $valid_token = is_valid_EuroBioImagingAliasToken($alias_token,$secret);
                if (!$valid_token){
                        $_SESSION['errorData']['Error'][]="euro-BioImaging Alias Token ($alias_token) is not valid. Please, generate a new one.";
			return false;
                }
		// Generate internally a new alias_token (token2). We cannot read token attributes (expiration date) from already issued tokens. 
                $r = createEuroBioImagingToken($_REQUEST['alias_token'],$_REQUEST['secret']);
                $r = json_decode($r,TRUE);
                if ($r['code'] != 200){
                        $_SESSION['errorData']['Error'][]="euro-BioImaging Alias Token not saved. Cannot issue a new token. Please, renew your credentials.";
			return false;
                }
		$token2 = $r['body'];
		if (!isset($token2['alias']) || !isset($token2['secret'])){
                        $_SESSION['errorData']['Error'][]="euro-BioImaging Alias Token not saved. Compulsory token attributes ('alias', 'secret') are missing.";
			return false;
		}
		addUserLinkedAccount($_SESSION['User']['_id'],"euBI",$token2);
		return true;
}
