<?php
$input = $_POST['input'];

// This key needs to be unique per install.
$privateKey = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDVd/gb2ORdLI7nTRHJR8C5EHs4RkRBcQuQdHkZ6eq0xnV2f0hk
WC8h0mYH/bmelb5ribwulMwzFkuktXoufqzoft6Q6jLQRnkNJGRP6yA4bXqXfKYj
1yeMusIPyIb3CTJT/gfZ40oli6szwu4DoFs66IZpJLv4qxU9hqu6NtJ+8QIDAQAB
AoGADbnXFENP+8W/spO8Dws0EzJCGg46mVKhgbpbhxUJaHJSXzoz92/MKAqVUPI5
mz7ZraR/mycqMia+2mpo3tB6YaKiOpjf9J6j+VGGO5sfRY/5VNGVEQ+JLiV0pUmM
doq8n2ZhKdSd5hZ4ulb4MFygzV4bmH29aIMvogMqx2Gkp3kCQQDx0UvBoNByr5hO
Rl0WmDiDMdWa9IkKD+EkUItR1XjpsfEQcwXet/3QlAqYf+FE/LBcnA79NdBGxoyJ
XS+O/p4rAkEA4f0JMSnIgjl7Tm3TpNmbHb7tsAHggWIrPstCuHCbNclmROfMvcDE
r560i1rbOtuvq5F/3BQs+QOnOIz1jLslUwJAbyEGNZfX87yqu94uTYHrBq/SQIH8
sHkXuH6jaBo4lP1HkY2qtu3LYR2HuQmb1v5hdk3pvYgLjVsVntMKVibBPQJBAKd2
Dj20LLTzS4BOuirKZbuhJBjtCyRVTp51mLd8Gke9Ol+NNZbXJejNvhQV+6ad7ItC
gnDfMoRERMIPElZ6x6kCQQCP45DVojZduLRuhJtzBkQXJ4pCsGC8mrHXF3M+hJV+
+LAYJbXrQa4mre59wR0skgb6CwGg1siMrDzJgu3lmBB0
-----END RSA PRIVATE KEY-----';

// Decrypted text
$decrypted = '';
openssl_private_decrypt(base64_decode($input), $decrypted, $privateKey);
$data = json_decode(base64_decode($decrypted), true);
if (!isset($data['time'])) {
    die("No time paramter in decoded message.");
}
$now = time();
if (!is_numeric($data['time'])) {
    die("Time should be numeric!");
} elseif ($data['time'] + 60*5 < $now) { // Timestamp should be within 5 minutes. This helps with replay attacks, but doesn't eliminate.
    die("Timestamp on login should be within the last 5 minutes. (stamp: ".$data['time']." now: ".$now.")");
}
if ($data['ipaddr'] != $_SERVER['REMOTE_ADDR']) {
    die("IP Login recieved from is not the IP the login provided. Try again?");
}

echo "Success! We got an encrypted login params of user: ".$data['user']." pass: ".$data['pass']." Timestamps: (stamp: ".$data['time']." now: ".$now.")";

?>
