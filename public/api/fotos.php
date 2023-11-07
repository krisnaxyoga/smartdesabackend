<?php
//API
include_once('koneksi.php');

// AWS API keys
$aws_access_key_id = 'AKIAUL6XC2PS65RAKKVQ';
$aws_secret_access_key = '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';

//API
$id = $_POST['id'];
$foto = base64_decode($_POST['foto']);

$nmb_rndm = rand(1000, 9999);
$tgl = date("Y-m-d");

// Bucket
$bucket_name ='glsdesa';

// AWS region and Host Name (Host names are different for each AWS region)
// As an example these are set to us-east-1 (US Standard)
$aws_region = 'ap-southeast-1';
$host_name = $bucket_name . '.s3-ap-southeast-1.amazonaws.com';

// Server path where content is present. This is just an example
// $content_path = 'img/color.png';
$content_path = 'img/color.png';
$content = file_get_contents($content_path);

// AWS file permissions
$content_acl = 'authenticated-read';

// MIME type of file. Very important to set if you later plan to load the file from a S3 url in the browser (images, for example)
$content_type = 'image/png';
// Name of content on S3
// $content_title = 'sample-image-8.png';
$content_title = "Penduduk-".$tgl.$nmb_rndm.$id.".jpeg";

//API
$response = array();

//API
$update = "UPDATE `penduduk` SET `foto` = '$nama_profil' WHERE `penduduk`.`id` = '$id'";

// Service name for S3
$aws_service_name = 's3';

// UTC timestamp and date
$timestamp = gmdate('Ymd\THis\Z');
$date = gmdate('Ymd');

// HTTP request headers as key & value
$request_headers = array();
$request_headers['Content-Type'] = $content_type;
$request_headers['Date'] = $timestamp;
$request_headers['Host'] = $host_name;
$request_headers['x-amz-acl'] = $content_acl;
$request_headers['x-amz-content-sha256'] = hash('sha256', $content);
// Sort it in ascending order
ksort($request_headers);

// Canonical headers
$canonical_headers = [];
foreach($request_headers as $key => $value) {
	$canonical_headers[] = strtolower($key) . ":" . $value;
}
$canonical_headers = implode("\n", $canonical_headers);

// Signed headers
$signed_headers = [];
foreach($request_headers as $key => $value) {
	$signed_headers[] = strtolower($key);
}
$signed_headers = implode(";", $signed_headers);

// Cannonical request 
$canonical_request = [];
$canonical_request[] = "PUT";
$canonical_request[] = "/" . $content_title;
$canonical_request[] = "";
$canonical_request[] = $canonical_headers;
$canonical_request[] = "";
$canonical_request[] = $signed_headers;
$canonical_request[] = hash('sha256', $content);
$canonical_request = implode("\n", $canonical_request);
$hashed_canonical_request = hash('sha256', $canonical_request);

// AWS Scope
$scope = [];
$scope[] = $date;
$scope[] = $aws_region;
$scope[] = $aws_service_name;
$scope[] = "aws4_request";

// String to sign
$string_to_sign = [];
$string_to_sign[] = "AWS4-HMAC-SHA256"; 
$string_to_sign[] = $timestamp; 
$string_to_sign[] = implode('/', $scope);
$string_to_sign[] = $hashed_canonical_request;
$string_to_sign = implode("\n", $string_to_sign);

// Signing key
$kSecret = 'AWS4' . $aws_secret_access_key;
$kDate = hash_hmac('sha256', $date, $kSecret, true);
$kRegion = hash_hmac('sha256', $aws_region, $kDate, true);
$kService = hash_hmac('sha256', $aws_service_name, $kRegion, true);
$kSigning = hash_hmac('sha256', 'aws4_request', $kService, true);

// Signature
$signature = hash_hmac('sha256', $string_to_sign, $kSigning);

// Authorization
$authorization = [
	'Credential=' . $aws_access_key_id . '/' . implode('/', $scope),
	'SignedHeaders=' . $signed_headers,
	'Signature=' . $signature
];
$authorization = 'AWS4-HMAC-SHA256' . ' ' . implode( ',', $authorization);

// Curl headers
$curl_headers = [ 'Authorization: ' . $authorization ];
foreach($request_headers as $key => $value) {
	$curl_headers[] = $key . ": " . $value;
}

$url = 'https://'.$host_name.'/'.'berita'.'/'.$content_title;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// if($http_code != 200) 
// 	exit('Error : Failed to upload');
	
//API
if(file_put_contents($ch, $foto)){
	$exeinsert = mysqli_query($koneksi, $update);
	if($exeinsert){
		$response['error']=true;
		$response['message']="Foto Berhasil Dirubah";
	}else{
		$response['error']=false;
		$response['message']="Foto Gagal Dirubah";
	}
}else{
		$response['error']=false;
		$response['message']="Gagal Upload Foto";
	}
	echo json_encode($response);

?>