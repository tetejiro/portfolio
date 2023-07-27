<?php

    $honbun='';
    $honbun.=$member_info[0]['name']."さんから、\n";
    $honbun.=$target_member_info[0]['name']."さんに質問したいことがあります。\n";
    $honbun.="内容は以下の通りです。\n";
    $honbun.="\n\n";
    $honbun.="----------------------------\n";
    $honbun.="〇件名\n";
    $honbun.=$post['title']."\n\n";
    $honbun.="〇依頼したいこと\n";
    $honbun.=$post['purpose']."\n\n";
    $honbun.="〇詳細\n";
    $honbun.=$post['detail']."\n\n";
    $honbun.="〇考えられる原因\n";
    $honbun.=$post['cause']."\n\n";
    $honbun.="〇試してみたこと・その他\n";
    $honbun.=$post['other']."\n\n";
    $honbun.="----------------------------\n";
    $honbun.="お手すきの際に、対応していただけますと嬉しいです。\n\n";
    $honbun.="※このメールは送信専用です。返信はできません。";

    $title='質問のお知らせです。';
    $header='From:info@snowy-hita-3070.cheap.jp';
    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($target_member_info[0]['mail'],$post['title'],$honbun,$header);

?>
