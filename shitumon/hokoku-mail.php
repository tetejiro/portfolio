<?php
    $honbun='';
    $honbun.=$member_info[0]['name']."さんから、\n";
    $honbun.=$target_member_info[0]['name']."さん宛てに報告・連絡が入りました。\n";
    $honbun.='返事は'.$post['rsvp'].'だそうです。';
    $honbun.="内容は以下の通りです。\n";
    $honbun.="\n\n";
    $honbun.="----------------------------\n";
    $honbun.="〇件名\n";
    $honbun.=$post['title']."\n\n";
    $honbun.="〇詳細\n";
    $honbun.=$post['detail']."\n\n";
    $honbun.="〇その他\n";
    $honbun.=$post['other']."\n\n";
    $honbun.="----------------------------\n\n";
    $honbun.="お手すきの際に、対応していただけますと幸いです。\n\n";
    $honbun.="※このメールは送信専用です。返信はできません。";

    $title='報告・連絡のお知らせです。※返答　'.$post['rsvp'];
    $header='From:info@snowy-hita-3070.cheap.jp';
    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($target_member_info[0]['mail'],$post['title'],$honbun,$header);

?>