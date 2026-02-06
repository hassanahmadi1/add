<?php

// @MrXeniTer

$ctx = stream_context_create(array('http'=>
array(
'timeout' => 0.5,
)
));

# آدرس لوگین کلیکر برای کرون جاب ثانیه ای
$url = "https://hoinrastetyty.s71.site/amirr/index.php";

if(file_exists('MadelineProto.log') && (filesize('MadelineProto.log')/1024) > 1500) unlink('MadelineProto.log');

if(!file_exists('data.json')){file_put_contents('data.json','{"admins":{}}');}

if(!file_exists('data/link.txt')){
file_put_contents('data/link.txt','');}

date_default_timezone_set('Asia/Tehran');
error_reporting(E_ALL);
ini_set('memory_limit' , '-1');
ini_set('max_execution_time','0');

if (file_exists('vendor/autoload.php')) {
require 'vendor/autoload.php';
} else {
if (!file_exists('madeline.php')) {
copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php'); }
include 'madeline.php'; }

use \danog\MadelineProto\API;
use \danog\Loop\Generic\GenericLoop;
use \danog\MadelineProto\EventHandler;
use \danog\MadelineProto\Shutdown;
class ZeusHandler extends EventHandler
{
const Report = 'Source_FranceIR';
public function getReportPeers()
{
return [self::Report];
}
public function genLoop()
{
yield $this->account->updateStatus([
'offline' => false
]);
file_get_contents($url, false, $ctx);
return 10 * 1800000000;
}
public function onStart()
{
$genLoop = new GenericLoop([$this, 'genLoop'], 'update Status');
$genLoop->start();
}
public function onUpdateNewChannelMessage($update)
{
yield $this->onUpdateNewMessage($update);
}
public function onUpdateNewMessage($update)
{
if (time() - $update['message']['date'] > 2) {
return;
}
try {
          $User_ID   = $update['message']['message'] ?? null;
      $Message_ID = $update['message']['id'] ?? 0;
$User_ID = $update['message']['from_id']['user_id']?? 0;
$Message = $update['message']['message']?? null;
$Message_ID = $update['message']['id']?? 0;
$MadelineProto = $this;
$Message_New = isset($update['message']) ? $update['message']:'';
$Reply_Post = $update['message']['reply_to']['reply_to_msg_id']?? 0;
$Me_Account = yield $this->get_self();
$Mes_ID = $Me_Account['id'];
$Information = yield $this->get_info($update);
$Chat_ID = yield $this->getID($update);
$Types_Account = $Information['type'];
@$Zeus_Data = json_decode(file_get_contents("data.json"), true);

$Admin_Zeus = 6933304781;

# Join Auto To Groups +1000 Member And Save Links
if (isset($update['message']['entities']) and preg_match_all('/\S+(t.me)\S+/i', $Message, $match)) {
foreach ($match[0] as $link) {
if (!in_array($link, file('data/link.txt', FILE_IGNORE_NEW_LINES))) {
try {
$ChatInvite = yield $this->messages->checkChatInvite(['hash' => $link]);
if ($ChatInvite['_'] == 'chatInvite' and $ChatInvite['broadcast'] != '1' and $ChatInvite['participants_count'] >= 5000)
yield $this->sleep(rand(10,20));
yield $this->channels->joinChannel(['channel' => $link]);
} catch (\Throwable $e) {
}
file_put_contents('data/link.txt', "$link\n", FILE_APPEND);
}
}
}

if($Message == 'چخبر' or $Message == 'خوبی'){
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => '🚶‍♀']);
}

if( $User_ID == $Admin_Zeus){


if($Message == 'Restart'){
yield $this->messages->deleteHistory(['just_clear' => true, 'revoke' => true, 'peer' => $Chat_ID, 'max_id' => $Message_ID]);
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => '♻️ بــا مـوفـقـیـت #راهانـدازی شــد']);
yield $this->restart();
}
if(preg_match("/^[\/\#\!]?(addadmin) (.*)$/i", $Message)){
preg_match("/^[\/\#\!]?(addadmin) (.*)$/i", $Message, $text1);
$id = $text1[2];
if (!isset($Zeus_Data['admins'][$id])) {
$Zeus_Data['admins'][$id] = $id;
file_put_contents("data.json", json_encode($Zeus_Data));
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => "↜ کاربر $id به لیست ادمین ها اضافه شد.",
'reply_to_msg_id' => $Message_ID,
'parse_mode'=>"MarkDown"
]);
}else{
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => "↜ کاربر $id از قبل در لیست ادمین ا بود.",
'reply_to_msg_id' => $Message_ID,
'parse_mode'=>"MarkDown"
]);
}
}

if(preg_match("/^[\/\#\!]?(deladmin) (.*)$/i", $Message)){
preg_match("/^[\/\#\!]?(deladmin) (.*)$/i", $Message, $text1);
$id = $text1[2];
if (isset($Zeus_Data['admins'][$id])) {
unset($Zeus_Data['admins'][$id]);
file_put_contents("data.json", json_encode($Zeus_Data));
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => "↜ کاربر $id از لیست ادمین ها حذف شد.",
'reply_to_msg_id' => $Message_ID,
'parse_mode'=>"MarkDown"
]);
}else{
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => "↜ کاربر $id از قبل در لیست ادمین ها نبود.",
'reply_to_msg_id' => $Message_ID,
'parse_mode'=>"MarkDown"
]);
}
}
 if(preg_match("/^[\/\#\!]?(cladmins)$/i", $Message)){
$Zeus_Data['admins'] = [];
file_put_contents("data.json", json_encode($Zeus_Data));
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => "↜ لیست ادمین خالی شد.",
'reply_to_msg_id' => $Message_ID
]);
}
 if(preg_match("/^[\/\#\!]?(adminlist)$/i", $Message)){
if(count($Zeus_Data['admins']) > 0){
$txxxt = "↜ لیست ادمین ها :
";
$counter = 1;
foreach($Zeus_Data['admins'] as $k){
$txxxt .= "$counter ↝ [$k](tg://user?id=$k)\n";
$counter++;
}
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => $txxxt,
'reply_to_msg_id' => $Message_ID,
'parse_mode'=>"MarkDown"
]);
}else{
yield $this->messages->sendMessage([
'peer'            => $Chat_ID,
'message'         => "↜ لیست ادمین ها خالی است.",
'reply_to_msg_id' => $Message_ID,
'parse_mode'=>"MarkDown"
]);
}
}
}
if ($User_ID == $Admin_Zeus || isset($Zeus_Data['admins'][$User_ID])){

if($Message == 'امار' or $Message == 'Stats'){
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message'=>'lodings...','reply_to_msg_id' => $Message_ID]);
$log = round(filesize('MadelineProto.log')/1024/1024,2) . 'MG';
$mem_using = round((memory_get_usage()/1024)/1024, 0).'MG';
$load = sys_getloadavg();
$ver = phpversion(); 
$server=PHP_OS;
$supergps = 0;
$channels = 0;
$pvs = 0;
$gps = 0;
$bots = 0;
$s = yield $this->get_dialogs();
foreach ($s as $peer) {
try {
$i = yield $this->get_info($peer);
if ($i['type'] == 'supergroup') $supergps++;
if ($i['type'] == 'channel') $channels++;
if ($i['type'] == 'user') $pvs++;
if ($i['type'] == 'chat') $gps++;
if ($i['type'] == 'bot') $bots++;
} catch (\Exception $e) {
} catch (\danog\MadelineProto\RPCErrorException $e) {}
}
$all = $gps+$supergps+$channels+$pvs;
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'reply_to_msg_id' => $Message_ID ,
'message' => "● STATS BOTS ADERINGS

»all : $all
»supergps : $supergps
»gps : $gps
»pvs : $pvs
»channels : $channels
»bots : $bots", 'parse_mode'=>"MarkDown"]);
if ($supergps > 350 || $pvs > 1500){
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'reply_to_msg_id' => $Message_ID ,
'message' => '❗️ هـرچـه سـریـعـتـر گـروه و کـانـال هـای ادر را کـم کـنــیـد']);
}
}

if($Message == '!Help' or $Message == 'راهنما'){
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => '
✅ راهنما کلینر پاکسازی پیام های گروه 
●●●●●●●●بخش ادمین●●●●●●●●●
• *افزودن ادمین* 
ᴥ `addadmin`
• *حذف کردن ادمین* 
ᴥ `deladmin`
• *پاکسازی لیست ادمین*
ᴥ `cladmins`
• *لیست تمام ادمین ها* 
ᴥ `adminlist`

●●●●●●●●دستورات●●●●●●●●●●●

• *اطلاع از آنلاینی ربات*
ᴥ `ربات` | `+`
• *ری استارت کلینر*
ᴥ `Restart`
• *اطلاع از مصرف ربات*
ᴥ `mem`
• *ورود به کانال یا گروه* 
ᴥ `join id`
●●●●●●بخش پاکسازی●●●●●●
• *پاکسازی کل کانال ها*
ᴥ `delchanel`
• *پاکسازی گروه به تعداد*
ᴥ `Delgroups 5`
• *خروج ربات از گروه*
ᴥ `left`
• *پاکسازی پیام های گروه بع تعداد*
ᴥ `del 1000`
■■■■■■■■■■■■■■■■■■■■
[☘AMIRHOSSINRASTEGAR🍀](https://t.me/DevtAmirphp6)
■■■■■■■■■■■■■■■■■■■■',
 'parse_mode' => 'markdown']);
}
}
if($Message == 'ربات' or $Message == '+'){
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => '♻️ • ربات پاکسازی گروه #انلاین میباشد✅']);
}
if($Message == 'rm'){
$log = round(filesize('MadelineProto.log')/1024/1024,2) . ' مگابایت';
$mem_using = round((memory_get_usage()/1024)/1024, 0).' مگابایت';
$load = sys_getloadavg();
$ver = phpversion(); 
$server=PHP_OS;
yield $this->messages->sendMessage([
'peer' => $Chat_ID,
'message' => "mem : *$mem_using* log : *$log* load : *$load[0]* ver : *$ver* mod : *$server*",
 'parse_mode' => 'markdown']);
}
# Left From Group
if(preg_match("/^[\/\#\!]?(خروج|left)$/i", $Message)){
$Types = yield $this->getInfo($Chat_ID);
$Types3 = $Types['type'];
if($Types3 == "supergroup"){
yield $this->messages->sendMessage(['peer' => $Chat_ID,'message' => "Boy):♡"]);
yield $this->channels->leaveChannel(['channel' => $Chat_ID, ]);
}else{
yield $this->messages->sendMessage(['peer' => $Chat_ID,'reply_to_msg_id' => $Message_id ,'message' => "در سوپر گروه از این دستور استفاده کنید ادمین عزیز!"]);
}
}
if(preg_match("/^[\/\#\!]?(del) ([0-9]+)$/i", $Message) && $Information['type'] == 'supergroup'){
preg_match("/^[\/\#\!]?(del) ([0-9]+)$/i", $Message, $tet);
if($tet[2] >= 1 && $tet[2] <= 100000000000){
$tet[2] = (int)$tet[2];
$clean = (int)($tet[2]/10);
for($i=1;$i<=$clean;$i++){
$msgid = [];
$pv = yield $this->messages->getHistory([
'peer' => $Chat_ID,
'offset_id' => 0, 
'offset_date' => 0,
'add_offset' => 0,
'limit' => 100,
'max_id' => 0,
'min_id' => 0,
'hash' => 0
]);
foreach($pv['messages'] as $message){
$msgid[] = $message['id'];
}
yield $this->channels->deleteMessages([
'revoke'=>true,
'channel' => $Chat_ID,
'id' => $msgid
]);
}
$txt = '✅ '.$tet[2].' پـیـام بـا مـوفـقـیـت پـاک شـد';
}
else {
$txt = '⛔';
}
yield $this->messages->sendMessage([
'peer' => $Chat_ID, 
'message' => $txt,
'reply_to_msg_id' => $Message_ID,
'parse_mode' => 'HTML'
]);
}
if($Message == 'delchanel' or $Message == 'پاکسازی کانال'){
yield
$this->messages->sendMessage(['peer' => $Chat_ID, 'message' =>'صبر...',
 'reply_to_msg_id' => $Message_ID]);
  $all = yield $this->get_dialogs();
  foreach ($all as $peer) {
  $type = yield $this->get_info($peer);
  $type3 = $type['type'];
  if($type3 == 'channel'){
  $id = $type['bot_api_id'];
  yield $this->channels->leaveChannel(['channel' => $id]);
 }
 } yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' =>'از همه ی کانال ها لفت دادم 👌','reply_to_msg_id' => $Message_ID]);
}

if(preg_match("/^[\/\#\!]?(Delgroups) (.*)$/i", $Message)){
preg_match("/^[\/\#\!]?(Delgroups) (.*)$/i", $Message, $text);
yield $this->messages->sendMessage(['peer' => $Chat_ID,'reply_to_msg_id' => $Message_ID, 'message' =>'صبر...',
'reply_to_msg_id' => $Message_ID]);
$count = 0;
$all = yield $this->get_dialogs();
foreach ($all as $peer) {
try {
$Types = yield $this->get_info($peer);
$Types3 = $Types['type'];
if($Types3 == 'supergroup' || $Types3 == 'chat'){
$id = $Types['bot_api_id'];
if($Chat_ID != $id){
yield $this->channels->leaveChannel(['channel' => $id]);
$count++;
if($count == $text[2]) {
break;
}
}
}
} catch(Exception $m){}
}
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => "تـعـداد `$text[2]` پاکسازی شد",'reply_to_msg_id' => $Message_ID,'parse_mode'=>"MarkDown"]);
}

 if(preg_match("/^[\/\#\!]?(Join) (.*)$/i", $Message)){
preg_match("/^[\/\#\!]?(Join) (.*)$/i", $Message, $text);
$id = $text[2];
try {
  yield $this->channels->joinChannel(['channel' => "$id"]);
  yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => '✅ Joined',
'reply_to_msg_id' => $Message_ID]);
} catch(Exception $e){
yield $this->messages->sendMessage(['peer' => $Chat_ID, 'message' => '❗️<code>'.$e->getMessage().'</code>',
'parse_mode'=>'html',
'reply_to_msg_id' => $Message_ID]);
}
}
} catch (\Throwable $e){
$this->report("Surfaced: $e");
}
}
}
$settings['db']['type'] = 'memory';
$settings = [
'serialization' => [
'cleanup_before_serialization' => true,
],
'logger' => [
'max_size' => 1*1024*1024,
],
'peer' => [
'full_fetch' => false,
'cache_all_peers_on_startup' => false,
],
'app_info' => [
'api_id' => 24375045,
'api_hash' => '704c6ab52e79116257c9da7bc560e94b'],
];
$Zeus = new \danog\MadelineProto\API('Zeus.Madeline', $settings);
$Zeus->startAndLoop(ZeusHandler::class);
?>