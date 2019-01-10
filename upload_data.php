<?php
/*
* File      : "upload_data.php"
* Author    : Mahadevaswamy.HN
* Copyright (C) NSN 2013
*/

// Database Constants
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "gsmbts");

// 1. Create a database connection
$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
if (!$connection) {
        die("Database connection failed: " . mysql_error());
}

// 2. Select a database to use
$db_select = mysql_select_db(DB_NAME,$connection);
if (!$db_select) {
        die("Database selection failed: " . mysql_error());
}

if ( $argc != 24 )
{
echo "Usage : php upload_data.php <bld_id> <branch_id> <RFM Med Ver> <RFM Veg Ver> <bld_start_time> <bld_swbt_time> <bld_release_time> <system> <ele_man> <base_band> <comp_launch> <common> <comments> <product> <RFM> <FRM> <BM> <PS> <VTC> <build_status> <JOB ID> <JOB NAME> <swbt>";
exit;
}
$bld_id = $argv[1];
$branch_id = $argv[2];
$rfm_m = $argv[3];
$rfm_v = $argv[4];

$bld_start_time = $argv[5];
$bld_swbt_time = $argv[6];
$bld_release_time = $argv[7];
$system = $argv[8];
$ele_man = $argv[9];
$base_band = $argv[10];
$srt = $argv[11];
$common = $argv[12];
$comments = $argv[13];
$product = $argv[14];
$rfm = $argv[15];
$frm = $argv[16];
$BM = $argv[17];
$PS = $argv[18];
$VTC = $argv[19];
$bld_status = $argv[20];
$job_id = $argv[21];
$job_name = $argv[22];
$swbt = $argv[23];
//date_default_timezone_set("Asia/kolkata");
date_default_timezone_set("Asia/Kolkata"); 
$bld_wk = date("W");
$bld_config = "isource_link";
$bld_url = "jenkins_bld_url";
$pkg_download = "bts_pkg";

$sql = mysql_query("select * from build_portal where bld_id = '$bld_id'");
$res = mysql_fetch_array($sql);
if (empty($res['bld_id']))
	{
	$sql = "INSERT INTO build_portal ( bld_id, branch_id, bld_wk, sfrl1, sfrl2, sfrl3, swbt_m, swbt_v, swbt, bld_config, bld_url, rfm_m, rfm_v, bld_start_time, bld_swbt_time, bld_release_time, pkg_download, sem_download,sys,ele_man,base_band,srt,common, comments, product, rfm, rfm_frm3_version, BM, PS, VTC, build_status, job_id, job_name  ) VALUES ('$bld_id', '$branch_id', '$bld_wk', '0', '0', '0', '0', '0', '$swbt', '$bld_config', '$bld_url', '$rfm_m', '$rfm_v', '$bld_start_time', '$bld_swbt_time', '$bld_release_time', '$pkg_download', 'sem_link', '$system', '$ele_man', '$base_band', '$srt', '$common', '$comments', '$product', '$rfm', '$frm', '$BM', '$PS', '$VTC', '$bld_status', '$job_id', '$job_name'  )" ;
	mysql_query($sql) or die(mysql_error());
	}
else
	{
	echo "Build already present";
        $sql = "update build_portal set branch_id='$branch_id',bld_wk='$bld_wk',sfrl1='0',sfrl2='0',sfrl3='0',swbt_m='0',swbt_v='0',swbt='',bld_config='$bld_config',bld_url='$bld_url', rfm_m='$rfm_m',rfm_v='$rfm_v', bld_start_time='$bld_start_time',bld_swbt_time='$bld_swbt_time',bld_release_time='$bld_release_time',pkg_download='$pkg_download',sem_download='sem_link',sys='$system',ele_man='$ele_man',base_band='$base_band',srt='$srt',common='$common',comments='$comments',product='$product', rfm='$rfm',rfm_frm3_version='$frm', BM='$BM',PS='$PS',VTC='$VTC',build_status='$bld_status', job_id='$job_id', job_name='$job_name', swbt='$swbt' where bld_id='$bld_id'";
	mysql_query($sql) or die(mysql_error());

}


?>

