<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="<?php echo THEME_URI; ?>/assets/images/favicon.png" />

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->	
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
$logoObj = get_field('hdlogo', 'options');
if( is_array($logoObj) ){
  $logo_tag = '<img src="'.$logoObj['url'].'" alt="'.$logoObj['alt'].'" title="'.$logoObj['title'].'">';
}else{
  $logo_tag = '';
}
?>
<div class="bdoverlay"></div>

<?php 
if( isset( $_POST['agevarification'] ) && $_POST['agevarification'] == 1 ) $_SESSION['agevarification'] = 1;
if( !isset( $_SESSION['agevarification'] ) ): 
?>
<div class="home-overlay">
  <div class="home-overlay-inr">
    <span class="home-overlay-graphics">
      <img src="<?php echo THEME_URI; ?>/assets/images/home-overlay-graphics.png">
    </span>
    <div class="home-overlay-des">
      <div class="logo-overlay">
        <a href="#"><img src="<?php echo THEME_URI; ?>/assets/images/logo-overlay.png"></a>
      </div>
      <p>BY ENTERING OUR SITE YOU AGREE THAT YOU ARE OF LEGAL DRINKING AGE</p>
      <form action="" method="POST">
        <input type="hidden" name="agevarification"  id="agevarification" value="1">
        <button type="submit" class="enter-now-btn" href="#">ENTER NOW</button>
      </form>
    </div>
  </div>
</div> 
<?php endif; ?>

<div class="hdr-gap"></div>
<header class="header">
  <span class="hdr-btm-angle">
    <svg class="hdr-btm-angle-svg svg-cntlr" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" width="1600.195" height="170.094" viewBox="0 0 1600.195 170.094">
      <g id="Header_Background" data-name="Header Background" transform="translate(0.098 0)">
        <g id="bottom_white_border_fff_" data-name="bottom white border (#fff)" stroke-miterlimit="10">
          <path d="M 1252.778076171875 152.1791534423828 C 1251.344116210938 152.1779174804688 1249.923828125 152.1388549804688 1248.52783203125 152.0722351074219 C 1249.92822265625 152.1385498046875 1251.3525390625 152.1778869628906 1252.778076171875 152.1791534423828 Z M 320.9831848144531 143.8759002685547 C 322.3242797851563 143.8065643310547 323.7243957519531 143.7708587646484 325.1958312988281 143.7679901123047 C 323.7401428222656 143.7708892822266 322.3379211425781 143.8065490722656 320.9831848144531 143.8759002685547 Z M 1594.408325195313 127.7095947265625 C 1594.249145507813 127.7095947265625 1594.08984375 127.7072372436523 1593.93017578125 127.7029113769531 C 1594.089111328125 127.7068481445313 1594.248046875 127.7089920043945 1594.406860351563 127.7089920043945 C 1594.499877929688 127.7089920043945 1594.595581054688 127.7083435058594 1594.693725585938 127.7067947387695 C 1594.599731445313 127.7086639404297 1594.504638671875 127.7095947265625 1594.408325195313 127.7095947265625 Z" stroke="none"/>
          <path d="M 1599.998901367188 125.093994140625 C 1599.998901367188 125.7599945068359 1599.999877929688 126.4269866943359 1599.999877929688 127.093994140625 C 1598.216674804688 128.3809051513672 1596.330322265625 128.7095031738281 1594.408203125 128.7095031738281 C 1592.401611328125 128.7095031738281 1590.35595703125 128.3512420654297 1588.3486328125 128.3512573242188 C 1587.851684570313 128.3512573242188 1587.35693359375 128.3732147216797 1586.865966796875 128.4279937744141 C 1574.3369140625 129.8259887695313 1561.714965820313 129.2319946289063 1549.10205078125 130.6479949951172 C 1537.717895507813 131.9259948730469 1526.573974609375 135.0459899902344 1515.050048828125 135.0929870605469 C 1514.265869140625 135.0959930419922 1513.409057617188 135.4599914550781 1512.7119140625 135.8699951171875 C 1509.117309570313 137.986328125 1505.333129882813 138.9606628417969 1501.484741210938 138.9606628417969 C 1499.283203125 138.9606628417969 1497.060302734375 138.6416015625 1494.840942382813 138.0349884033203 C 1488.452392578125 136.288818359375 1482.06982421875 135.7040100097656 1475.689086914063 135.7040710449219 C 1465.407104492188 135.7041473388672 1455.131469726563 137.222900390625 1444.854858398438 137.8479919433594 C 1436.4951171875 138.3556823730469 1428.123657226563 139.4084167480469 1419.79296875 139.4084167480469 C 1412.469482421875 139.4084167480469 1405.177001953125 138.5944366455078 1397.9560546875 135.8809967041016 C 1397.52294921875 135.7181549072266 1397.045776367188 135.6647186279297 1396.549194335938 135.6647338867188 C 1395.728271484375 135.6647338867188 1394.854125976563 135.8107452392578 1394.037963867188 135.8499908447266 C 1385.395874023438 136.2689971923828 1377.65087890625 140.7269897460938 1368.7841796875 140.8429870605469 C 1358.623046875 140.9749908447266 1349.159912109375 145.7009887695313 1339.078857421875 147.0579986572266 C 1328.732177734375 148.4509887695313 1318.363891601563 149.5829925537109 1308.238891601563 152.5269927978516 C 1301.255249023438 154.5577545166016 1294.1826171875 155.7915954589844 1287.064331054688 155.7915954589844 C 1281.893310546875 155.7915954589844 1276.69775390625 155.1401824951172 1271.496948242188 153.6699981689453 C 1268.978637695313 152.9585571289063 1266.378173828125 152.5563812255859 1263.819458007813 152.5564422607422 C 1262.907470703125 152.5564575195313 1262.000366210938 152.6075744628906 1261.10498046875 152.7139892578125 C 1258.340087890625 153.0417633056641 1255.591186523438 153.1792602539063 1252.848754882813 153.1792602539063 C 1247.793212890625 153.1792602539063 1242.762817382813 152.7115173339844 1237.717041015625 152.1059875488281 C 1236.42041015625 151.9501953125 1235.133422851563 151.8482971191406 1233.86328125 151.8483428955078 C 1230.527587890625 151.8484649658203 1227.3134765625 152.5516967773438 1224.383911132813 154.8279876708984 C 1223.515991210938 155.5026397705078 1222.137817382813 155.8240203857422 1220.952392578125 155.8240203857422 C 1220.837646484375 155.8240203857422 1220.724487304688 155.8209991455078 1220.613891601563 155.8149871826172 C 1218.525512695313 155.7001953125 1216.451171875 155.6428527832031 1214.383178710938 155.6428527832031 C 1207.750244140625 155.6428833007813 1201.18701171875 156.2329559326172 1194.470947265625 157.4099884033203 C 1180.279052734375 159.8979949951172 1165.847900390625 161.4229888916016 1151.728881835938 164.2789916992188 C 1146.349609375 165.3675384521484 1141.168334960938 166.3857727050781 1135.928955078125 166.3857727050781 C 1132.668212890625 166.3857727050781 1129.384887695313 165.9913177490234 1126.017944335938 164.9739990234375 C 1124.401123046875 164.4852600097656 1122.66845703125 164.3555755615234 1120.900268554688 164.3555755615234 C 1118.971069335938 164.3555908203125 1116.999755859375 164.5100402832031 1115.092041015625 164.52099609375 C 1109.19482421875 164.5550079345703 1103.265380859375 164.9919738769531 1097.376586914063 164.9919738769531 C 1094.783447265625 164.9919738769531 1092.19775390625 164.9072113037109 1089.626953125 164.6660003662109 C 1087.089965820313 164.4280853271484 1084.594360351563 164.2791748046875 1082.13916015625 164.2792510986328 C 1074.6767578125 164.2794647216797 1067.60302734375 165.6560974121094 1060.998901367188 170.093994140625 L 1050.998901367188 170.093994140625 C 1049.754638671875 168.9230346679688 1048.174560546875 168.6470184326172 1046.669067382813 168.6470489501953 C 1046.2216796875 168.6470642089844 1045.780517578125 168.6714477539063 1045.357177734375 168.7039947509766 C 1044.455322265625 168.7732849121094 1043.566162109375 168.8106231689453 1042.6875 168.8106231689453 C 1038.380859375 168.8106231689453 1034.3466796875 167.9125518798828 1030.536865234375 165.4789886474609 C 1029.347900390625 164.718994140625 1027.642822265625 164.8009948730469 1026.2021484375 164.3989868164063 C 1019.168212890625 162.4379577636719 1012.023986816406 162.1619415283203 1004.861511230469 162.1619873046875 C 1002.053833007813 162.1620025634766 999.24365234375 162.2044219970703 996.4365844726563 162.2044219970703 C 994.7049560546875 162.2044219970703 992.9727783203125 162.1882476806641 991.2449340820313 162.1360015869141 C 990.9254760742188 162.1262512207031 990.6036987304688 162.1211547851563 990.280029296875 162.1211547851563 C 987.7803344726563 162.1211700439453 985.1814575195313 162.4251098632813 982.8759155273438 163.2369995117188 C 978.8469848632813 164.6570129394531 974.7618408203125 165.3660430908203 970.7232055664063 165.3660430908203 C 966.8638305664063 165.3660430908203 963.0468139648438 164.7184448242188 959.3629150390625 163.4249877929688 C 951.8318481445313 160.780517578125 944.173583984375 160.5722961425781 936.5184936523438 160.5722961425781 C 935.0872192382813 160.5722961425781 933.6561279296875 160.5795745849609 932.2259521484375 160.5795745849609 C 929.4228515625 160.5795745849609 926.6229858398438 160.5515899658203 923.8339233398438 160.3860015869141 C 922.9396362304688 160.3329162597656 922.0453491210938 160.3155517578125 921.149169921875 160.3155517578125 C 919.4493408203125 160.3155670166016 917.7446899414063 160.3781127929688 916.0325927734375 160.3781127929688 C 913.5966796875 160.3781127929688 911.1444702148438 160.2514801025391 908.6658935546875 159.6380004882813 C 899.5335693359375 157.3785095214844 890.1519165039063 156.3132019042969 880.7830200195313 156.3132476806641 C 879.7359619140625 156.3132476806641 878.6884765625 156.3265533447266 877.64208984375 156.3529968261719 C 873.8261108398438 156.449462890625 870.0159301757813 156.7595062255859 866.1954345703125 156.7595062255859 C 864.70947265625 156.7595062255859 863.221923828125 156.7126007080078 861.73193359375 156.5879974365234 C 858.4302978515625 156.3119506835938 855.0513916015625 156.1000213623047 851.7058715820313 156.1000518798828 C 847.1133422851563 156.10009765625 842.5845336914063 156.4995880126953 838.4119262695313 157.6809997558594 C 827.8898315429688 160.6599273681641 817.4379272460938 162.0076141357422 806.8055419921875 162.0076141357422 C 803.903564453125 162.0076141357422 800.986572265625 161.9071197509766 798.0529174804688 161.7119903564453 C 797.4544067382813 161.6721649169922 796.8528442382813 161.6546173095703 796.250244140625 161.6546173095703 C 795.188720703125 161.6546325683594 794.1240844726563 161.7090759277344 793.0689086914063 161.7919921875 C 788.7925415039063 162.1292266845703 784.5233764648438 162.3392181396484 780.2598876953125 162.3392181396484 C 774.06787109375 162.3392181396484 767.8892211914063 161.8960266113281 761.7288818359375 160.7559967041016 C 759.7889404296875 160.3969879150391 757.76708984375 160.4169921875 755.7808837890625 160.3919982910156 C 755.206298828125 160.3845672607422 754.6322631835938 160.3813934326172 754.056884765625 160.3813934326172 C 750.6871948242188 160.3814239501953 747.3062744140625 160.4903411865234 743.9378662109375 160.4903411865234 C 740.9931640625 160.4903411865234 738.05712890625 160.4070587158203 735.1459350585938 160.0950012207031 C 727.218017578125 159.2453918457031 719.3596801757813 157.2995147705078 711.4228515625 157.2996978759766 C 707.6825561523438 157.2997894287109 703.923828125 157.7320861816406 700.1339111328125 158.9149932861328 C 699.7532958984375 159.033935546875 699.3222045898438 159.0902557373047 698.8842163085938 159.0902557373047 C 698.2911987304688 159.0902557373047 697.6856079101563 158.9869537353516 697.1760864257813 158.7959899902344 C 695.2515869140625 158.0757293701172 693.3287353515625 157.8354339599609 691.4048461914063 157.8354644775391 C 688.7211303710938 157.8354949951172 686.03564453125 158.3031768798828 683.3428955078125 158.5879974365234 C 678.572998046875 159.0916290283203 673.8836059570313 159.6836547851563 669.0687866210938 159.6836547851563 C 667.2489624023438 159.6836547851563 665.4102783203125 159.5989837646484 663.5438842773438 159.3929901123047 C 657.8905639648438 158.7689056396484 652.1009521484375 156.9386138916016 646.3460693359375 156.9386596679688 C 642.6400146484375 156.9386901855469 638.9481811523438 157.6977996826172 635.31689453125 160.0269927978516 C 635.1024780273438 160.1647033691406 634.8302612304688 160.2133331298828 634.5267333984375 160.2133331298828 C 633.8646850585938 160.2133331298828 633.0540771484375 159.9818725585938 632.3718872070313 159.93798828125 C 618.3988647460938 159.0329437255859 604.4439697265625 157.6834869384766 590.4525756835938 157.6836700439453 C 583.666748046875 157.6837615966797 576.8702392578125 158.0013122558594 570.0628662109375 158.8409881591797 C 565.330810546875 159.4251556396484 560.4320068359375 159.9502868652344 555.6690673828125 159.9502868652344 C 553.4688720703125 159.9502868652344 551.2969970703125 159.8381500244141 549.18505859375 159.5679931640625 C 538.341064453125 158.1799926757813 527.174072265625 159.1929931640625 516.616943359375 155.7569885253906 C 514.331787109375 155.0134887695313 512.0028076171875 154.8287048339844 509.671142578125 154.8287353515625 C 507.365966796875 154.8287506103516 505.0587158203125 155.0093688964844 502.7896728515625 155.0093688964844 C 500.9609375 155.0093688964844 499.156494140625 154.8919525146484 497.39892578125 154.4679870605469 C 478.9781494140625 150.0239868164063 460.0771484375 150.8829956054688 441.4981689453125 148.4619903564453 C 439.7110595703125 148.2292175292969 437.92431640625 148.1443176269531 436.1373291015625 148.1443481445313 C 431.3114013671875 148.1444396972656 426.4906005859375 148.7639312744141 421.7010498046875 148.7639312744141 C 420.324951171875 148.7639312744141 418.9503173828125 148.7127380371094 417.5799560546875 148.5809936523438 C 406.525146484375 147.5179901123047 395.5418701171875 145.5959930419922 384.5799560546875 143.7309875488281 C 381.8111572265625 143.259521484375 379.0654296875 142.9545593261719 376.322265625 142.9545745849609 C 374.771484375 142.95458984375 373.221435546875 143.0520629882813 371.6689453125 143.2719879150391 C 363.3004150390625 144.4563446044922 355.080810546875 145.5964050292969 346.537841796875 145.5964050292969 C 345.119384765625 145.5964050292969 343.690185546875 145.5649108886719 342.251953125 145.4969940185547 C 336.6964111328125 145.2339935302734 331.041015625 144.7677001953125 325.3885498046875 144.7678070068359 C 318.725830078125 144.7679443359375 312.0677490234375 145.4160766601563 305.5928955078125 147.8089904785156 C 305.3009033203125 147.9170532226563 304.968505859375 147.9592590332031 304.629638671875 147.9592590332031 C 304.2847900390625 147.9592590332031 303.9332275390625 147.91552734375 303.6109619140625 147.8529968261719 C 298.693359375 146.9003143310547 293.7843017578125 146.5673065185547 288.8731689453125 146.5673828125 C 281.7369384765625 146.5674743652344 274.5980224609375 147.2708129882813 267.4359130859375 147.7979888916016 C 265.17822265625 147.9640808105469 262.88720703125 148.0597534179688 260.5911865234375 148.0597534179688 C 255.8782958984375 148.0597534179688 251.1463623046875 147.6564483642578 246.65185546875 146.6309967041016 C 243.1683349609375 145.8359680175781 239.7431640625 145.2086639404297 236.3641357421875 145.2086639404297 C 235.046630859375 145.2086639404297 233.736083984375 145.3040313720703 232.431884765625 145.5219879150391 C 225.52587890625 146.6759948730469 218.7188720703125 147.1479949951172 211.6978759765625 147.1669921875 C 194.0609130859375 147.2159881591797 176.56689453125 149.9659881591797 158.9619140625 151.0739898681641 C 152.1351318359375 151.5036468505859 145.32568359375 152.2001342773438 138.544921875 152.2001342773438 C 134.089111328125 152.2001342773438 129.644775390625 151.899169921875 125.2188720703125 151.0239868164063 C 113.029052734375 148.6133422851563 100.65185546875 147.4500274658203 88.395751953125 147.4501190185547 C 87.1177978515625 147.4501190185547 85.83984375 147.4627838134766 84.56494140625 147.4879913330078 C 70.899169921875 147.7589874267578 56.990966796875 147.3659973144531 43.451904296875 150.4799957275391 C 40.669189453125 151.1196746826172 37.866455078125 151.2386322021484 35.0484619140625 151.2386322021484 C 33.3782958984375 151.2386322021484 31.703125 151.1968231201172 30.024169921875 151.1968231201172 C 27.4281005859375 151.1968536376953 24.822265625 151.2968597412109 22.212890625 151.8059997558594 C 16.5347900390625 152.9134979248047 10.76123046875 154.4880065917969 4.86181640625 154.4880065917969 C 3.25048828125 154.4880065917969 1.629638671875 154.3705291748047 -0.0010986328125 154.093994140625 C -0.0010986328125 153.4269866943359 -0.0001220703125 152.7599945068359 -0.0001220703125 152.093994140625 C 1.630859375 152.37060546875 3.2506103515625 152.4880065917969 4.8623046875 152.4880065917969 C 10.7607421875 152.4880065917969 16.5352783203125 150.9134063720703 22.212890625 149.8059997558594 C 24.8226318359375 149.2967681884766 27.4276123046875 149.1968231201172 30.024169921875 149.1968231201172 C 31.703125 149.1968231201172 33.3782958984375 149.2386322021484 35.0484619140625 149.2386322021484 C 37.865966796875 149.2386322021484 40.6695556640625 149.1195831298828 43.451904296875 148.4799957275391 C 56.990966796875 145.3659973144531 70.899169921875 145.7589874267578 84.56494140625 145.4879913330078 C 85.840576171875 145.4627685546875 87.116943359375 145.4501190185547 88.395751953125 145.4501190185547 C 100.6510009765625 145.4501190185547 113.0299072265625 146.6135101318359 125.2188720703125 149.0239868164063 C 129.6453857421875 149.8993072509766 134.08837890625 150.2001342773438 138.544921875 150.2001342773438 C 145.3250732421875 150.2001342773438 152.1358642578125 149.5036163330078 158.9619140625 149.0739898681641 C 176.56689453125 147.9659881591797 194.0609130859375 145.2159881591797 211.6978759765625 145.1669921875 C 218.7188720703125 145.1479949951172 225.52587890625 144.6759948730469 232.431884765625 143.5219879150391 C 233.736328125 143.3039855957031 235.04638671875 143.2086639404297 236.3641357421875 143.2086639404297 C 239.742919921875 143.2086639404297 243.1685791015625 143.8360290527344 246.65185546875 144.6309967041016 C 251.1468505859375 145.6565399169922 255.8778076171875 146.0597534179688 260.5911865234375 146.0597534179688 C 262.88671875 146.0597534179688 265.1787109375 145.9640502929688 267.4359130859375 145.7979888916016 C 274.5987548828125 145.270751953125 281.7362060546875 144.5673828125 288.8731689453125 144.5673828125 C 293.7835693359375 144.5673828125 298.694091796875 144.9004516601563 303.6109619140625 145.8529968261719 C 303.9332275390625 145.9155426025391 304.2847900390625 145.9592590332031 304.629638671875 145.9592590332031 C 304.968505859375 145.9592590332031 305.301025390625 145.9170379638672 305.5928955078125 145.8089904785156 C 312.0684814453125 143.4158172607422 318.72509765625 142.7678070068359 325.3885498046875 142.7678070068359 C 331.040283203125 142.7678070068359 336.6971435546875 143.2340240478516 342.251953125 143.4969940185547 C 343.69091796875 143.56494140625 345.1187744140625 143.5964050292969 346.537841796875 143.5964050292969 C 355.0802001953125 143.5964050292969 363.301025390625 142.4562683105469 371.6689453125 141.2719879150391 C 373.2216796875 141.0520172119141 374.771240234375 140.9545745849609 376.322265625 140.9545745849609 C 379.065185546875 140.9545745849609 381.8114013671875 141.2595672607422 384.5799560546875 141.7309875488281 C 395.5418701171875 143.5959930419922 406.525146484375 145.5179901123047 417.5799560546875 146.5809936523438 C 418.9508056640625 146.7127838134766 420.324462890625 146.7639312744141 421.7010498046875 146.7639312744141 C 426.4906005859375 146.7639312744141 431.3114013671875 146.1443481445313 436.1373291015625 146.1443481445313 C 437.923828125 146.1443481445313 439.7115478515625 146.2292938232422 441.4981689453125 146.4619903564453 C 460.0771484375 148.8829956054688 478.9781494140625 148.0239868164063 497.39892578125 152.4679870605469 C 499.1568603515625 152.8920440673828 500.96044921875 153.0093688964844 502.7896728515625 153.0093688964844 C 505.0587158203125 153.0093688964844 507.365966796875 152.8287353515625 509.671142578125 152.8287353515625 C 512.00244140625 152.8287353515625 514.3321533203125 153.0136108398438 516.616943359375 153.7569885253906 C 527.174072265625 157.1929931640625 538.341064453125 156.1799926757813 549.18505859375 157.5679931640625 C 551.2974853515625 157.8382110595703 553.4683837890625 157.9502868652344 555.6690673828125 157.9502868652344 C 560.431640625 157.9502868652344 565.331298828125 157.4250946044922 570.0628662109375 156.8409881591797 C 576.8714599609375 156.0011444091797 583.6654663085938 155.6836700439453 590.4525756835938 155.6836700439453 C 604.4426879882813 155.6836700439453 618.4000854492188 157.0330200195313 632.3718872070313 157.93798828125 C 633.0541381835938 157.9818725585938 633.8646850585938 158.2133331298828 634.5267333984375 158.2133331298828 C 634.8302001953125 158.2133331298828 635.1025390625 158.1646728515625 635.31689453125 158.0269927978516 C 638.94873046875 155.6974487304688 642.639404296875 154.9386596679688 646.3460693359375 154.9386596679688 C 652.1004028320313 154.9386596679688 657.8911743164063 156.7689666748047 663.5438842773438 157.3929901123047 C 665.41064453125 157.5990295410156 667.2485961914063 157.6836547851563 669.0687866210938 157.6836547851563 C 673.8831787109375 157.6836547851563 678.5733642578125 157.0915985107422 683.3428955078125 156.5879974365234 C 686.035888671875 156.3031463623047 688.7208251953125 155.8354644775391 691.4048461914063 155.8354644775391 C 693.3284912109375 155.8354644775391 695.2518310546875 156.0758361816406 697.1760864257813 156.7959899902344 C 697.6856689453125 156.9869842529297 698.2911376953125 157.0902557373047 698.8842163085938 157.0902557373047 C 699.3221435546875 157.0902557373047 699.7533569335938 157.0339202880859 700.1339111328125 156.9149932861328 C 703.924560546875 155.7318572998047 707.6818237304688 155.2996978759766 711.4228515625 155.2996978759766 C 719.3589477539063 155.2996978759766 727.21875 157.2454681396484 735.1459350585938 158.0950012207031 C 738.0575561523438 158.4071044921875 740.9927368164063 158.4903411865234 743.9378662109375 158.4903411865234 C 747.3062744140625 158.4903411865234 750.6871948242188 158.3813934326172 754.056884765625 158.3813934326172 C 754.6318359375 158.3813934326172 755.2067260742188 158.3845672607422 755.7808837890625 158.3919982910156 C 757.76708984375 158.4169921875 759.7889404296875 158.3969879150391 761.7288818359375 158.7559967041016 C 767.8898315429688 159.8961486816406 774.0672607421875 160.3392181396484 780.2598876953125 160.3392181396484 C 784.522705078125 160.3392181396484 788.793212890625 160.1291809082031 793.0689086914063 159.7919921875 C 794.1242065429688 159.7090606689453 795.1885986328125 159.6546173095703 796.250244140625 159.6546173095703 C 796.852783203125 159.6546173095703 797.4544677734375 159.6721649169922 798.0529174804688 159.7119903564453 C 800.9873657226563 159.9071655273438 803.9027709960938 160.0076141357422 806.8055419921875 160.0076141357422 C 817.4370727539063 160.0076141357422 827.890625 158.6596984863281 838.4119262695313 155.6809997558594 C 842.5849609375 154.4994659423828 847.1128540039063 154.1000518798828 851.7058715820313 154.1000518798828 C 855.0509033203125 154.1000518798828 858.4307861328125 154.3119812011719 861.73193359375 154.5879974365234 C 863.2222900390625 154.7126312255859 864.7091674804688 154.7595062255859 866.1954345703125 154.7595062255859 C 870.015625 154.7595062255859 873.826416015625 154.449462890625 877.64208984375 154.3529968261719 C 878.6890869140625 154.3265380859375 879.7352905273438 154.3132476806641 880.7830200195313 154.3132476806641 C 890.1512451171875 154.3132476806641 899.5341796875 155.378662109375 908.6658935546875 157.6380004882813 C 911.144775390625 158.2515563964844 913.5963745117188 158.3781127929688 916.0325927734375 158.3781127929688 C 917.7446899414063 158.3781127929688 919.4493408203125 158.3155517578125 921.149169921875 158.3155517578125 C 922.0450439453125 158.3155517578125 922.93994140625 158.3329315185547 923.8339233398438 158.3860015869141 C 926.6237182617188 158.5516357421875 929.422119140625 158.57958984375 932.2259521484375 158.57958984375 C 933.6561279296875 158.57958984375 935.0872192382813 158.5722961425781 936.5184936523438 158.5722961425781 C 944.1728515625 158.5722961425781 951.83251953125 158.7807769775391 959.3629150390625 161.4249877929688 C 963.0473022460938 162.7186126708984 966.8633422851563 163.3660430908203 970.7232055664063 163.3660430908203 C 974.7614135742188 163.3660430908203 978.8474731445313 162.6568450927734 982.8759155273438 161.2369995117188 C 985.1815795898438 160.425048828125 987.7801513671875 160.1211547851563 990.280029296875 160.1211547851563 C 990.603515625 160.1211547851563 990.9255981445313 160.1262512207031 991.2449340820313 160.1360015869141 C 992.9735107421875 160.1882629394531 994.7042236328125 160.2044219970703 996.4365844726563 160.2044219970703 C 999.24365234375 160.2044219970703 1002.053833007813 160.1619873046875 1004.861511230469 160.1619873046875 C 1012.023254394531 160.1619873046875 1019.168884277344 160.4381408691406 1026.2021484375 162.3989868164063 C 1027.642822265625 162.8009948730469 1029.347900390625 162.718994140625 1030.536865234375 163.4789886474609 C 1034.346923828125 165.9127349853516 1038.380493164063 166.8106231689453 1042.6875 166.8106231689453 C 1043.565795898438 166.8106231689453 1044.455688476563 166.7732696533203 1045.357177734375 166.7039947509766 C 1045.780517578125 166.6714477539063 1046.221435546875 166.6470489501953 1046.669067382813 166.6470489501953 C 1048.17431640625 166.6470489501953 1049.7548828125 166.9231262207031 1050.998901367188 168.093994140625 L 1060.998901367188 168.093994140625 C 1067.603637695313 163.6557312011719 1074.676147460938 162.2792510986328 1082.13916015625 162.2792510986328 C 1084.59375 162.2792510986328 1087.090576171875 162.4281463623047 1089.626953125 162.6660003662109 C 1092.1982421875 162.9072570800781 1094.782958984375 162.9919738769531 1097.376586914063 162.9919738769531 C 1103.264770507813 162.9919738769531 1109.1953125 162.5550079345703 1115.092041015625 162.52099609375 C 1117 162.5100402832031 1118.970947265625 162.3555755615234 1120.900268554688 162.3555755615234 C 1122.668212890625 162.3555755615234 1124.401245117188 162.4853210449219 1126.017944335938 162.9739990234375 C 1129.385498046875 163.9914855957031 1132.667724609375 164.3857727050781 1135.928955078125 164.3857727050781 C 1141.167846679688 164.3857727050781 1146.35009765625 163.367431640625 1151.728881835938 162.2789916992188 C 1165.847900390625 159.4229888916016 1180.279052734375 157.8979949951172 1194.470947265625 155.4099884033203 C 1201.1875 154.2328643798828 1207.749633789063 153.6428527832031 1214.383178710938 153.6428527832031 C 1216.450561523438 153.6428527832031 1218.526123046875 153.7002258300781 1220.613891601563 153.8149871826172 C 1220.724609375 153.8209991455078 1220.837524414063 153.8240203857422 1220.952392578125 153.8240203857422 C 1222.137817382813 153.8240203857422 1223.51611328125 153.5025939941406 1224.383911132813 152.8279876708984 C 1227.313720703125 150.551513671875 1230.52734375 149.8483428955078 1233.86328125 149.8483428955078 C 1235.133178710938 149.8483428955078 1236.420776367188 149.9502258300781 1237.717041015625 150.1059875488281 C 1242.763305664063 150.7115783691406 1247.792724609375 151.1792602539063 1252.848754882813 151.1792602539063 C 1255.590698242188 151.1792602539063 1258.340576171875 151.0417022705078 1261.10498046875 150.7139892578125 C 1262.000610351563 150.6075592041016 1262.9072265625 150.5564422607422 1263.819458007813 150.5564422607422 C 1266.3779296875 150.5564422607422 1268.978881835938 150.9586181640625 1271.496948242188 151.6699981689453 C 1276.698486328125 153.1403961181641 1281.892578125 153.7915954589844 1287.064331054688 153.7915954589844 C 1294.181884765625 153.7915954589844 1301.255981445313 152.5575408935547 1308.238891601563 150.5269927978516 C 1318.363891601563 147.5829925537109 1328.732177734375 146.4509887695313 1339.078857421875 145.0579986572266 C 1349.159912109375 143.7009887695313 1358.623046875 138.9749908447266 1368.7841796875 138.8429870605469 C 1377.65087890625 138.7269897460938 1385.395874023438 134.2689971923828 1394.037963867188 133.8499908447266 C 1394.854248046875 133.8107452392578 1395.728149414063 133.6647338867188 1396.549194335938 133.6647338867188 C 1397.045654296875 133.6647338867188 1397.52294921875 133.7181701660156 1397.9560546875 133.8809967041016 C 1405.177978515625 136.5947875976563 1412.468505859375 137.4084167480469 1419.79296875 137.4084167480469 C 1428.122680664063 137.4084167480469 1436.49609375 136.3556213378906 1444.854858398438 135.8479919433594 C 1455.132568359375 135.2228393554688 1465.406127929688 133.7040710449219 1475.689086914063 133.7040710449219 C 1482.068725585938 133.7040710449219 1488.453369140625 134.2890930175781 1494.840942382813 136.0349884033203 C 1497.060668945313 136.6417083740234 1499.282958984375 136.9606628417969 1501.484741210938 136.9606628417969 C 1505.332763671875 136.9606628417969 1509.117553710938 135.9861297607422 1512.7119140625 133.8699951171875 C 1513.409057617188 133.4599914550781 1514.265869140625 133.0959930419922 1515.050048828125 133.0929870605469 C 1526.573974609375 133.0459899902344 1537.717895507813 129.9259948730469 1549.10205078125 128.6479949951172 C 1561.714965820313 127.2319946289063 1574.3369140625 127.8259887695313 1586.865966796875 126.4279937744141 C 1587.357543945313 126.3731536865234 1587.851806640625 126.3512268066406 1588.349243164063 126.3512268066406 C 1590.35595703125 126.3512268066406 1592.401000976563 126.7090759277344 1594.406860351563 126.7090759277344 C 1596.328857421875 126.7090759277344 1598.215576171875 126.3804626464844 1599.998901367188 125.093994140625 Z" stroke="none" fill="#fff"/>
        </g>
        <path id="Torn_background_000_" data-name="Torn background (#000)" d="M1061,168.094h-10c-1.614-1.519-3.794-1.532-5.642-1.39-5.322.409-10.233-.295-14.82-3.225-1.189-.76-2.894-.678-4.335-1.08-11.492-3.2-23.283-1.91-34.957-2.263a23.537,23.537,0,0,0-8.369,1.1,35.008,35.008,0,0,1-23.513.188c-11.7-4.108-23.706-2.337-35.529-3.039-5-.3-10.029.524-15.168-.748a116.949,116.949,0,0,0-31.024-3.285c-5.3.134-10.589.68-15.91.235-7.834-.655-16.108-.949-23.32,1.093a117.373,117.373,0,0,1-40.359,4.031,34.561,34.561,0,0,0-4.984.08c-10.487.827-20.938.889-31.34-1.036a35.274,35.274,0,0,0-5.948-.364c-6.882-.089-13.825.433-20.635-.3-11.664-1.25-23.18-4.873-35.012-1.18a4.888,4.888,0,0,1-2.958-.119c-4.609-1.725-9.21-.7-13.833-.208-6.573.694-12.995,1.556-19.8.805-9.294-1.026-18.957-5.312-28.227.634-.682.438-1.95-.025-2.945-.089-20.75-1.344-41.466-3.668-62.309-1.1-6.918.854-14.194,1.582-20.878.726-10.844-1.387-22.011-.374-32.568-3.81-6.365-2.071-13.074.193-19.218-1.289-18.421-4.444-37.322-3.585-55.9-6.006-8-1.042-16.012.879-23.918.119-11.055-1.063-22.038-2.985-33-4.85a41.618,41.618,0,0,0-12.911-.459c-9.758,1.381-19.316,2.7-29.418,2.225-12.1-.573-24.69-2.111-36.658,2.312a3.883,3.883,0,0,1-1.982.044c-12.063-2.337-24.084-.945-36.175-.055a71.172,71.172,0,0,1-20.784-1.167c-4.842-1.1-9.571-1.886-14.22-1.109a126.649,126.649,0,0,1-20.734,1.645c-17.637.049-35.131,2.8-52.736,3.907-11.313.712-22.582,2.157-33.743-.05a190.541,190.541,0,0,0-40.654-3.536c-13.666.271-27.574-.122-41.113,2.992-6.982,1.605-14.095-.068-21.239,1.326C14.984,151.216,7.6,153.383,0,152.094q0-73.75-.1-147.5C-.109.843.75,0,4.5,0Q501.749.152,999,.094,1297.25.094,1595.5,0c3.75,0,4.613.842,4.6,4.594-.157,40.166-.1,80.333-.1,120.5-4.1,2.963-8.758.846-13.133,1.334-12.529,1.4-25.151.8-37.764,2.22-11.384,1.278-22.528,4.4-34.052,4.445a4.968,4.968,0,0,0-2.338.777,22.493,22.493,0,0,1-17.871,2.165c-16.683-4.56-33.332-1.2-49.986-.187-15.709.954-31.464,3.833-46.9-1.967-1.149-.432-2.608-.094-3.918-.031-8.642.419-16.387,4.877-25.254,4.993-10.161.132-19.624,4.858-29.705,6.215-10.347,1.393-20.715,2.525-30.841,5.469-12.056,3.506-24.381,4.637-36.741,1.143a26.877,26.877,0,0,0-10.392-.956c-7.862.933-15.6.326-23.388-.608-4.7-.565-9.288-.421-13.333,2.722a6.062,6.062,0,0,1-3.77.987,113.476,113.476,0,0,0-26.143,1.6c-14.192,2.488-28.623,4.013-42.742,6.869-8.727,1.766-16.934,3.347-25.711.695-3.381-1.022-7.27-.474-10.926-.453-8.494.049-17.056.934-25.465.145C1079.379,161.705,1069.776,162.2,1061,168.094Z"/>
      </g>
    </svg>
  </span>
  <div class="hdr-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="header-inr clearfix">
              <div class="hdr-lft">
                <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                  <?php echo $logo_tag; ?>
                </a>
                </div>
              </div>
              <div class="hdr-rgt">
                <div class="hdr-rgt-inr">
                  <nav class="main-nav">
                  <?php 
                    $menuOptions = array( 
                        'theme_location' => 'cbv_main_menu', 
                        'menu_class' => 'clearfix reset-list',
                        'container' => '',
                        'container_class' => ''
                      );
                    wp_nav_menu( $menuOptions ); 
                  ?>
                  </nav>
                  <div class="hdr-humbergar">
                    <div class="hdr-humbergur-btn">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                    <div class="hdr-toogle-menu">
                      <ul class="reset-list clearfix">
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a></li>
                        <li><a href="#">Lorem Ipsum</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <div class="xs-nav-cntlr">
    <div class="xs-nav-inr">
      <div class="text-right clearfix">
        <div class="menu-closebtn">
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="xs-main-nav">
        <?php 
          $menuOptions = array( 
              'theme_location' => 'cbv_main_menu', 
              'menu_class' => 'clearfix reset-list',
              'container' => '',
              'container_class' => ''
            );
          wp_nav_menu( $menuOptions ); 
        ?>
      </div>
      <?php 
        $instagram = get_field('instagram_url', 'options');
        $facebook = get_field('facebook_url', 'options');
        $twitter = get_field('twitter_url', 'options');
        $snapchat = get_field('snapchat_url', 'options');
        $youtube = get_field('youtube_url', 'options');
      ?>
      <div class="xs-popup-btm-content">
        <ul class="reset-list">
          <?php if( !empty( $facebook ) ): ?>
          <li><a href="<?php echo $facebook; ?>"><i class="fab fa-facebook-f"></i></a></li>
          <?php endif; if( !empty( $twitter ) ): ?>
          <li><a href="<?php echo $twitter; ?>"><i class="fab fa-twitter"></i></a></li>
          <?php endif; if( !empty( $instagram ) ): ?>
          <li><a href="<?php echo $instagram; ?>"><i class="fab fa-instagram"></i></a></li>
          <?php endif; if( !empty( $snapchat ) ): ?>
          <li><a href="<?php echo $snapchat; ?>"><i class="fab fa-snapchat-ghost"></i></a></li>
          <?php endif; if( !empty( $youtube ) ): ?>
          <li><a href="<?php echo $youtube; ?>"><i class="fab fa-youtube"></i></a></li>
        <?php endif; ?>


        </ul>
      </div>
    </div>
  </div>
</header>
<?php 
if( is_page('contact1') ){
  $bgclass = ' hasBg';
} else {
  $bgclass = '';
}
?>
<div class="sections-cntlr<?php echo $bgclass;?>">
<div class="section-graphics-top">
  <img src="<?php echo THEME_URI; ?>/assets/images/section-graphics-top.png"></div>