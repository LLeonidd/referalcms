<?php
// Referal scripts
// This script needs to be included on the client side
// URL_REFERAL_CRM http://ref.lleonidd.tmweb.ru/api/inputpoint

$URL_REFERAL_CRM = '';

function _request_to_refcms($url){
	$data = json_encode(array(
		'_headers' => array_change_key_case(getallheaders()),//
		'_ref' => $_GET['ref'] ?? NULL,
	));
	$ch = curl_init($url);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	return $r = json_decode($response);
}
if(!empty($_GET['ref'])){
	 session_unset();
	 // Security check
	 $_GET['ref'] = preg_replace("#[^a-z\_\-0-9]+#i",'',$_GET['ref']);
	 if ($_GET['ref'] != '') {
	   $r = _request_to_refcms($URL_REFERAL_CRM);
	   if ($r!=null){
			 $_SESSION['ref_login']=true;
	     foreach ($r->setting as $data){
	       $_SESSION['number'] = $data->number;
	       $_SESSION['address'] = $data->address;
	       $_SESSION['email'] = $data->email;
	       $_SESSION['message'] = $data->message;
	       $_SESSION['rules'] = $data->rules;
	     }
	     $_SESSION['statistic_id'] = $r->statistic_id;
	   }
	 }
}
?>
<?php
if ($_SESSION['ref_login'] == true){?>
	 <script>
	 	function formatPhoneNumber(phoneNumberString) {
	     var cleaned = ('' + phoneNumberString).replace(/\D/g, '')
	     var match = cleaned.match(/^(1|)?(\d{3})(\d{3})(\d{2})(\d{2})$/)
	     if (match) {
	       var intlCode = (match[1] ? '+1 ' : '')
	       return [intlCode, '(', match[2], ') ', match[3], '-', match[4], '-', match[5]].join('')
	     }
	     return null
	   }

	 $phone_number_raw = '<?php echo $_SESSION['number'];?>'
	 $phone_number_human = formatPhoneNumber('<?php echo $_SESSION['number'];?>')
	 $whats_app_message = '<?php echo $_SESSION['message']; ?>'
	 $address = '<?php echo $_SESSION['address']; ?>'

	 eval("<?php echo $_SESSION['rules'];?>")
 </script>
<? } ?>
