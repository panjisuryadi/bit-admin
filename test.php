<?php

// {
//     "email": "email_user",
//     "device_id": "{device-id-user-tipe-EVA}",
//     "name": "getFile",
//     "description": "To get or retrieve files that has stored by the AI Agent Bot. The file could be document, image, video, audio or any other type of files.",
//     "parameters": "{\"type\":\"object\",\"properties\":{\"file_description\":{\"type\":\"string\",\"description\":\"The description or the name of the file to be retrieved.\"}},\"required\":[\"file_description\"]}",
//     "exec_type": "eva-getdocument",
//     "endpoint": "https://broadcast.eva.id/simpan_dokumen/findDocument",
//     "method": "POST",
//     "headers": "{\"api_key\": \"s4ved0c\"}",
//     "body_type": "form-data",
//     "body": "[{\"key\":\"file_title\",\"type\":\"text\",\"value\":\"{file_description}\"},{\"key\":\"file_desc\",\"type\":\"text\",\"value\":\"{file_description}\"},{\"key\":\"file_folder\",\"type\":\"text\",\"value\":\"\"},{\"key\":\"bot_id\",\"type\":\"text\",\"value\":\"{$otokata.account_msisdn}\"},{\"key\":\"user_id\",\"type\":\"text\",\"value\":\"{$otokata.account_user_id}\"}]",
//     "credentials": "null",
//     "response_filter": "",
//     "response_prompt": "The response will contain the file details. Provide a human-readable summary. Do not write the file or image URL, just show the filename (if any)",
//     "response_media_type": "",
//     "response_media_url": ""
// }

// ON KAN SIMPAN DOKUMEN
$parameters['type'] = 'object';
$parameters['properties']['file_description']['type'] = 'string';
$parameters['properties']['file_description']['description'] = 'The description or the name of the file to be retrieved.';
$parameters['required'] = ['file_description'];

$headers['api_key'] = 's4ved0c';

$bodys = array();

// Correct the structure to match the expected output format
$bodys[] = array(
    'key' => 'file_title',
    'type' => 'text',
    'value' => '{file_description}'
);

$bodys[] = array(
    'key' => 'file_desc',
    'type' => 'text',
    'value' => '{file_description}'
);

$bodys[] = array(
    'key' => 'file_folder',
    'type' => 'text',
    'value' => ''
);

$bodys[] = array(
    'key' => 'bot_id',
    'type' => 'text',
    'value' => '{$otokata.account_msisdn}'
);

$bodys[] = array(
    'key' => 'user_id',
    'type' => 'text',
    'value' => '{$otokata.account_user_id}'
);

$data_dokumen['email'] = 'email_user';
$data_dokumen['device_id'] = '{device-id-user-tipe-EVA}';
$data_dokumen['name'] = 'getFile';
$data_dokumen['description'] = 'To get or retrieve files that has stored by the AI Agent Bot. The file could be document, image, video, audio or any other type of files.';
$data_dokumen['parameters'] = json_encode($parameters);
$data_dokumen['exec_type'] = 'eva-getdocument';
$data_dokumen['endpoint'] = 'https://broadcast.eva.id/simpan_dokumen/findDocument';
$data_dokumen['method'] = 'POST';
$data_dokumen['headers'] = json_encode($headers);
$data_dokumen['body_type'] = 'form-data';
$data_dokumen['body'] = json_encode($bodys);
$data_dokumen['credentials'] = 'null';
$data_dokumen['response_filter'] = '';
$data_dokumen['response_prompt'] = 'The response will contain the file details. Provide a human-readable summary. Do not write the file or image URL, just show the filename (if any)';
$data_dokumen['response_media_type'] = '';
$data_dokumen['response_media_url'] = '';

// echo(json_encode($data_dokumen, JSON_PRETTY_PRINT));

echo(json_encode($data_dokumen));