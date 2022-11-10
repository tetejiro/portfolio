<?php

//  mail
    $honbun='';
    $honbun.=$whosename."さんから、\n";
    $honbun.=$name."さんに質問したいことがあります。\n";
    $honbun.="内容は以下の通りです。\n";
    $honbun.="\n\n";
    $honbun.="----------------------------\n";
    $honbun.="〇件名\n";
    $honbun.=$situation."\n\n";
    $honbun.="〇依頼したいこと\n";
    $honbun.="$goal\n\n";
    $honbun.="〇詳細\n";
    $honbun.=$what."\n\n";
    $honbun.="〇考えられる原因\n";
    $honbun.="$why\n\n";
    $honbun.="〇試してみたこと・その他\n";
    $honbun.=$try."\n\n";
    $honbun.="----------------------------\n";
    $honbun.="お手すきの際に、対応していただけますと嬉しいです。\n\n";
    $honbun.="※このメールは送信専用です。返信はできません。";

    $title='質問のお知らせです。';
    $header='From:info@snowy-hita-3070.cheap.jp';
    $honbun=html_entity_decode($honbun,ENT_QUOTES,'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail($mail,$title,$honbun,$header);

?>
