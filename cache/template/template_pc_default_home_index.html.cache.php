<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width">
    <meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>
    <meta content="<?php echo $meta_keywords; ?>" name="keywords" />
    <meta content="<?php echo $meta_description; ?>" name="description" />
    <meta name="next-head-count" content="9">
    <link rel="stylesheet" href="/template/pc/default/home/static/css/aea1918a79394435.css" data-n-g="">

<link rel="stylesheet" href="/template/pc/default/home/static/css/index.css" data-n-p="">
    
  </head>
  <body>
      
      <?php $menucolor=dr_site_value('cdbjs');?>

      <div class="nav fixed w-full left-0 top-0 z-[100] h-[110px]" style="background-color:<?php echo $menucolor; ?>">
        <nav class="h-[100%] flex w-[100%] justify-between px-[80px] items-center">
          <div class="logo">
             <img alt="" src="/template/pc/default/home/static/icon/cheers-up-logo.png" style="width:210px;" class="logoimg">
          </div>
          <div class="flex">
            <ul>
              <li>
                  
                  <?php $twitter=dr_site_value('twitter'); $opensea=dr_site_value('opensea'); $discord=dr_site_value('discord');?>

               <a class="" target="_blank" href="<?php echo $twitter; ?>">
                     <img class="tuite" src="/template/pc/default/home/static/image/tuite.png" alt="" style="width:30px;">
               </a>
              </li>
               <li>
                  <a class="" target="_blank" href="<?php echo $discord; ?>"><img class="discord" src="/template/pc/default/home/static/image/discord.png" alt="" style="width:30px;"></a>
              </li>
              <li>
                  <a class="" target="_blank" href="<?php echo $opensea; ?>"><img class="OpenSea" src="/template/pc/default/home/static/image/OpenSea-fill.png" alt="" style="width:30px;"></a>
              </li>
<li>
  <div class="relative">
    <div class="menu current-locale flex justify-center items-center cursor-pointer">
      <span class="language mr-[4px] font-black">CN</span>
    </div>
    <div style="display:none;" class="menu-list dropdown absolute -top-[8px] -left-[18px] w-[78px] h-[64px] p-[4px] rounded-[6px] bg-white shadow-[0_1.55952px_3.11905px_rgba(0,0,0,0.2)] transition">
        <a href="/index.php?en">
            <div class="item text-black h-[26px] flex items-center rounded-[4px] transition hover:bg-black hover:text-white">
                <div class="w-[24px] text-center">
                    
                </div>
            <div><font style="vertical-align: inherit;">EN</font></div>
        </div></a>
        <a href="/index.php"><div class="item text-black h-[26px] flex items-center rounded-[4px] transition hover:bg-black hover:text-white mt-[4px]"><div class="w-[24px] text-center"><svg viewBox="0 0 14 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="h-[10px]">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13 2.297A1.2 1.2 0 0 0 11.303.6L5.4 6.503 2.697 3.8A1.2 1.2 0 0 0 1 5.497L4.55 9.048a1.198 1.198 0 0 0 1.698 0L13 2.299Z"></path>
                        </svg></div><div><font style="vertical-align: inherit;">CN</font></div></div></a></div>
  </div>
</li>
            </ul>
            <ul class="account-ul">
              <li>
                  <?php $walletconnect=dr_site_value('wallet_connect');?>
                  <a href="<?php echo $walletconnect; ?>">
                <button class="connect-btn" tabindex="0" type="button">
                  <span class="w-[100%] text-[16px] font-medium">CONNECT WALLET</span>
                </button></a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="bg-black">
          
          <div class="cheers_up__banner relative">
             
                   <?php $bannercolor=dr_site_value('sybannerbjys');?>

            <div class="video-bg overflow-hidden" style="background-color: <?php echo $bannercolor; ?>;">
                <div style="font-size: 50px;
margin-top: 150px;font-weight: 100;
text-align: center;color: #fff;"><?php $mytitle=dr_site_value('bannerzbt'); echo $mytitle; ?></div>
              
             

               <?php $myhdtp=dr_site_value('shouyebanner'); $hdtp = current($myhdtp); ?>


            
          

              
              <img src="<?php echo dr_get_file($hdtp); ?>" alt="" class="w-full align-top rounded-b-[60px] overflow-hidden" style="border-radius:0;">
              
              
            </div>
            <div class="cheers_up__scroll_text h-[40px] bg-[url(&#x27;/template/pc/default/home/static/cheers-up/scrolltext1x.jpg&#x27;)] bg-contain bg-repeat-x animate-[scrollx_2s_linear_infinite] transform-gpu">
            </div>
            <div class="w-[110px] h-[110px] flex items-center justify-center cursor-pointer absolute bottom-[110px] right-[54px]" style="display:none;">
              <div class="w-[100px] h-[100px] rounded-full bg-black animate-[scale_4s_linear_infinite]">
              </div>
              <div class="w-[92px] h-[92px] rounded-full overflow-hidden absolute flex items-center justify-center transition hover:scale-110">
                <img src="/template/pc/default/home/static/image/arrow-down.png" alt="" class="h-[52px] animate-[arrowdown_4s_linear_infinite]">
              </div>
            </div>
          </div>
          <?php $onebg=dr_site_value('xmjjbjs');?>
          <div class="w-full left-0 top-0 pt-[80px] pb-[100px]" style="background-color:<?php echo $onebg; ?>">
          <div class="one container">
            <div class="w-[55.25%] mr-[3.52%]">
              <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                
                
                 <?php $myxmjjzt=dr_site_value('xmjjzt'); $jzt = current($myxmjjzt); ?>


                <img alt="cheersup" src="<?php echo dr_get_file($jzt); ?>" style="width:100%;">
                
                
              </span>
            </div>
            <div class="w-[42.97%] min-w-[420px]">
              <div class="text-[14px] leading-[22px] mb-[32px] text-black">
                  <div class="title">????????????</div><br/>
                  <?php $mysite=dr_site_value('xmjj'); echo $mysite; ?>
                 
                <br>
              </div>
              <div class="text-white font-[&#x27;Roboto&#x27;]">
                <div>
                  <div class="bg-[#18191C] px-[32px] py-[24px] rounded-[16px] relative mt-[12px] first:mt-0 first:after:content-none after:content-[&#x27;&#x27;] after:block after:absolute after:w-[8px] after:h-[12px] after:-top-[12px] after:left-[32px] after:bg-[#18191C]">
                    <div class="flex justify-between items-center">
                      <div class="text-[18px] font-medium">Get allow list</div>
                      <div class="text-[16px] font-normal" style="opacity:0.2">CLOSED</div>
                    </div>
                  </div>
                  <div class="bg-[#18191C] px-[32px] py-[24px] rounded-[16px] relative mt-[12px] first:mt-0 first:after:content-none after:content-[&#x27;&#x27;] after:block after:absolute after:w-[8px] after:h-[12px] after:-top-[12px] after:left-[32px] after:bg-[#18191C]">
                    <div class="flex justify-between items-center">
                      <div class="text-[18px] font-medium">
                        <a target="_blank" href="javascript:;">Verify winner list
                          <!-- -->&gt;</a>
                      </div>
                      <div class="text-[16px] font-normal" style="opacity:1">ANNOUNCED</div>
                    </div>
                  </div>
                  <div class="bg-[#18191C] px-[32px] py-[24px] rounded-[16px] relative mt-[12px] first:mt-0 first:after:content-none after:content-[&#x27;&#x27;] after:block after:absolute after:w-[8px] after:h-[12px] after:-top-[12px] after:left-[32px] after:bg-[#18191C]">
                    <div class="flex justify-between items-center">
                      <div class="text-[18px] font-medium">
                        <span class="font-weight">xxx-</span>minted</div>
                      <div class="text-[16px] font-normal" style="opacity:1">COMPLETED</div>
                    </div>
                    <div class="mt-[24px]">
                      <button class="MuiLoadingButton-root MuiButton-root MuiButton-outlined MuiButton-outlinedPrimary MuiButton-sizeMedium MuiButton-outlinedSizeMedium MuiButtonBase-root Mui-disabled w-full h-[94px] rounded-full text-[18px] font-normal bg-[#E0E0E0] css-18xvno" tabindex="-1" type="button" disabled="">
                        <span class="text-[#C9CCD0]">MINT</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
          <?php $twobg=dr_site_value('morebjs');?>
          <div class="w-full left-0 top-0 pt-[80px] pb-[100px]" style="background-color:<?php echo $twobg; ?>">
          <div class="two container">
            <?php $myxmjjyt=dr_site_value('xmjjyt'); $jyt = current($myxmjjyt); ?>
            <img src="<?php echo dr_get_file($jyt); ?>" alt="" class="w-[51.25%] align-top mt-[122px]">
            <div class="w-[42.97%] mr-[5%]">
                <div class="two title">
               MORE
              </div>
              <div class="text-black text-[14px] leading-[22px] mt-[40px] font-[&quot;Roboto&quot;]">
                <div class="mt-[40px]">
                    
                     <?php $moretxt=dr_site_value('xmjjgd'); echo $moretxt; ?>

                    
                    
                
               
                </div>
              </div>
            </div>
            
          </div>
          </div>
          <?php $threebg=dr_site_value('cyweb3bjs');?>
          <div class="w-full left-0 top-0 pt-[80px] pb-[100px]" style="background-color:<?php echo $threebg; ?>">
          <div class="three container">

              <div class="three title">
               ??????web3
              </div>
<div>
  <div class="style_roadmap-item__JBIDt" style="color:#FFC045">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 style_roadmap-wrap__wSX36 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters">
      <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters style_roadmap-title__1YpeM" tabindex="0" role="button" aria-expanded="false">
        <div class="style_roadmap-head__2RhFd MuiAccordionSummary-content MuiAccordionSummary-contentGutters">
        </div>
      </div>
      <div class="tianwei MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="display: none;">
        <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
          <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
            <div role="region" class="MuiAccordion-region">
              <div class="MuiAccordionDetails-root style_roadmap-body__KhT2q css-u7qq7e" style="background-color:#FFC045">
                   <?php $web3sm=dr_site_value('cyweb3lb'); echo $web3sm; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style_roadmap-wow__rFv5y" style="color:#FFC045">
    </div>
    <div class="style_roadmap-man__1Imib">
      <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
        <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
          <img class="man-1" alt="" aria-hidden="true" src="/template/pc/default/home/static/roadmap/man/1.png">
        </span>
    
      </span>
    </div>
    <div class="style_roadmap-shim__d4_M7">
    </div>
    <div class="style_roadmap-shadow-title__mcQnu">
      <div>
        <div class="style_icon__loGT6" style="color:#FFC045">
           <img alt="order-1" src="/template/pc/default/home/static/roadmap/order/1.png">
        </div>
        <span class="style_text__EIkOQ text-white">??????</span>
      </div>
      <div class="style_open__mXmIr">
          <img alt="open" src="/template/pc/default/home/static/roadmap/open.svg" class="opentianwei">
      </div>
    </div>
  </div>
  <div class="style_roadmap-item__JBIDt" style="color:#F6E3D8">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 style_roadmap-wrap__wSX36 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters">
      <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters style_roadmap-title__1YpeM css-1iji0d4" tabindex="0" role="button" aria-expanded="false">
        <div class="style_roadmap-head__2RhFd MuiAccordionSummary-content MuiAccordionSummary-contentGutters css-17o5nyn">
        </div>
      </div>
      <div class="tianwei MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="display:none;">
        <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
          <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
            <div role="region" class="MuiAccordion-region">
              <div class="MuiAccordionDetails-root style_roadmap-body__KhT2q css-u7qq7e" style="background-color:#F6E3D8">
                  
             <?php $web3yyzst=dr_site_value('cyweb3lbyyzst'); echo $web3yyzst; ?>

              
         
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style_roadmap-wow__rFv5y" style="color:#F6E3D8">
    </div>
    <div class="style_roadmap-man__1Imib">
      <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
        <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
          <img class="man-1" alt="" aria-hidden="true" src="/template/pc/default/home/img/roadmap/man/2.png">
        </span>

      </span>
    </div>
    <div class="style_roadmap-shim__d4_M7">
    </div>
    <div class="style_roadmap-shadow-title__mcQnu">
      <div>
        <div class="style_icon__loGT6" style="color:#F6E3D8">
          <img alt="order-1" src="/template/pc/default/home/static/roadmap/order/2.png">
        </div>
        <span class="style_text__EIkOQ text-white">???????????????</span>
      </div>
       <div class="style_open__mXmIr">
          <img alt="open" src="/template/pc/default/home/static/roadmap/open.svg" class="opentianwei">
      </div>
    </div>
  </div>
  <div class="style_roadmap-item__JBIDt" style="color:#FE8FB4">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 style_roadmap-wrap__wSX36 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters">
      <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters style_roadmap-title__1YpeM css-1iji0d4" tabindex="0" role="button" aria-expanded="false">
        <div class="style_roadmap-head__2RhFd MuiAccordionSummary-content MuiAccordionSummary-contentGutters css-17o5nyn">
        </div>
      </div>
      <div class="tianwei MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="display:none;">
        <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
          <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
            <div role="region" class="MuiAccordion-region">
              <div class="MuiAccordionDetails-root style_roadmap-body__KhT2q css-u7qq7e" style="background-color:#FE8FB4">
                  
                   <?php $web3sqjs=dr_site_value('cyweb3sqjs'); echo $web3sqjs; ?>


                
   
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style_roadmap-wow__rFv5y" style="color:#FE8FB4">
    </div>
    <div class="style_roadmap-man__1Imib">
      <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
        <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
          <img class="man-1" alt="" aria-hidden="true" src="/template/pc/default/home/img/roadmap/man/3.png">
        </span>

      </span>
    </div>
    <div class="style_roadmap-shim__d4_M7">
    </div>
    <div class="style_roadmap-shadow-title__mcQnu">
      <div>
        <div class="style_icon__loGT6" style="color:#FE8FB4">
          <img alt="order-1" src="/template/pc/default/home/static/roadmap/order/3.png">
        </div>
        <span class="style_text__EIkOQ text-white">????????????</span>
      </div>
       <div class="style_open__mXmIr">
          <img alt="open" src="/template/pc/default/home/static/roadmap/open.svg" class="opentianwei">
      </div>
    </div>
  </div>
  <div class="style_roadmap-item__JBIDt" style="color:#FFAD92">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 style_roadmap-wrap__wSX36 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters">
      <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters style_roadmap-title__1YpeM css-1iji0d4" tabindex="0" role="button" aria-expanded="false">
        <div class="style_roadmap-head__2RhFd MuiAccordionSummary-content MuiAccordionSummary-contentGutters css-17o5nyn">
        </div>
      </div>
      <div class="tianwei MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="display:none;">
        <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
          <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
            <div role="region" class="MuiAccordion-region">
              <div class="MuiAccordionDetails-root style_roadmap-body__KhT2q css-u7qq7e" style="background-color:#FFAD92">
             <?php $web3IPjs=dr_site_value('cyweb3IPjs'); echo $web3IPjs; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style_roadmap-wow__rFv5y" style="color:#FFAD92">
    </div>
    <div class="style_roadmap-man__1Imib">
      <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
        <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
          <img class="man-1" alt="" aria-hidden="true" src="/template/pc/default/home/static/roadmap/man/4.png">
        </span>
      </span>
    </div>
    <div class="style_roadmap-shim__d4_M7">
    </div>
    <div class="style_roadmap-shadow-title__mcQnu">
      <div>
        <div class="style_icon__loGT6" style="color:#FFAD92">
         <img alt="order-1" src="/template/pc/default/home/static/roadmap/order/4.png">
        </div>
        <span class="style_text__EIkOQ">IP??????</span>
      </div>
       <div class="style_open__mXmIr">
          <img alt="open" src="/template/pc/default/home/static/roadmap/open.svg" class="opentianwei">
      </div>
    </div>
  </div>
  <div class="style_roadmap-item__JBIDt" style="color:#91DDF3">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 style_roadmap-wrap__wSX36 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters">
      <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters style_roadmap-title__1YpeM css-1iji0d4" tabindex="0" role="button" aria-expanded="false">
        <div class="style_roadmap-head__2RhFd MuiAccordionSummary-content MuiAccordionSummary-contentGutters css-17o5nyn">
        </div>
      </div>
      <div class="tianwei MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="display:none;">
        <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
          <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
            <div role="region" class="MuiAccordion-region">
              <div class="MuiAccordionDetails-root style_roadmap-body__KhT2q css-u7qq7e" style="background-color:#91DDF3">
                <?php $web3sqfl=dr_site_value('cyweb3sqfl'); echo $web3sqfl; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style_roadmap-wow__rFv5y" style="color:#91DDF3">
    </div>
    <div class="style_roadmap-man__1Imib">
      <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
        <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
          <img class="man-1" alt="" aria-hidden="true" src="/template/pc/default/home/img/roadmap/man/6.png">
        </span>
      </span>
    </div>
    <div class="style_roadmap-shim__d4_M7">
    </div>
    <div class="style_roadmap-shadow-title__mcQnu">
      <div>
        <div class="style_icon__loGT6" style="color:#91DDF3">
          <img alt="order-1" src="/template/pc/default/home/static/roadmap/order/5.png">
        </div>
        <span class="style_text__EIkOQ">????????????</span>
      </div>
       <div class="style_open__mXmIr">
          <img alt="open" src="/template/pc/default/home/static/roadmap/open.svg" class="opentianwei">
      </div>
    </div>
  </div>
  <div class="style_roadmap-item__JBIDt box-shadow-none" style="color:#97A1FC">
    <div class="MuiPaper-root MuiPaper-elevation MuiPaper-rounded MuiPaper-elevation1 style_roadmap-wrap__wSX36 MuiAccordion-root MuiAccordion-rounded MuiAccordion-gutters">
      <div class="MuiButtonBase-root MuiAccordionSummary-root MuiAccordionSummary-gutters style_roadmap-title__1YpeM css-1iji0d4" tabindex="0" role="button" aria-expanded="false">
        <div class="style_roadmap-head__2RhFd MuiAccordionSummary-content MuiAccordionSummary-contentGutters css-17o5nyn">
        </div>
      </div>
      <div class="tianwei MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="display:none;">
        <div class="MuiCollapse-wrapper MuiCollapse-vertical css-hboir5">
          <div class="MuiCollapse-wrapperInner MuiCollapse-vertical css-8atqhb">
            <div role="region" class="MuiAccordion-region">
              <div class="MuiAccordionDetails-root style_roadmap-body__KhT2q css-u7qq7e" style="background-color:#97A1FC">
              <?php $web3cyjz=dr_site_value('cyweb3cyjz'); echo $web3cyjz; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="style_roadmap-wow__rFv5y box-shadow-none" style="color:#97A1FC">
    </div>
    <div class="style_roadmap-man__1Imib">
      <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
        <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
          <img class="man-1" alt="" aria-hidden="true" src="/template/pc/default/home/static/roadmap/man/1.png">
        </span>
      </span>
    </div>
    <div class="style_roadmap-shim__d4_M7">
    </div>
    <div class="style_roadmap-shadow-title__mcQnu">
      <div>
        <div class="style_icon__loGT6" style="color:#91DDF3">
          <img alt="order-1" src="/template/pc/default/home/static/roadmap/order/6.png">
        </div>
        <span class="style_text__EIkOQ">????????????</span>
      </div>
       <div class="style_open__mXmIr">
          <img alt="open" src="/template/pc/default/home/static/roadmap/open.svg" class="opentianwei">
      </div>
    </div>
  </div>
</div>

          </div>
          </div>
          
          <?php $fourbg=dr_site_value('fzlcbjs');?>
          <div class="w-full left-0 top-0 pb-[100px]" style="background-color:<?php echo $fourbg; ?>">
          <div class="four container">
            <div class="title">????????????</div>
              <?php $fzlczt=dr_site_value('fzlczt'); $fzlczt = current($fzlczt); ?>
             
           <div id="tianwei" class="MuiCollapse-root MuiCollapse-vertical MuiCollapse-hidden" style="text-align: center;">
         <img src="<?php echo dr_get_file($fzlczt); ?>" alt="" class="" style="padding-top:50px;padding-bottom:50px;padding-top: 50px;padding-bottom: 50px;width: 80%;
padding-left: 5%;
padding-right: 5%;">
      </div>
          </div>
          </div>
          <?php $mytuandui=dr_site_value('tuanduipeitu'); $tuanduibg=dr_site_value('tdbjs');?>
          <div class="w-full left-0 top-0 pt-[80px] pb-[100px]" style="background-color:<?php echo $tuanduibg; ?>;">
              
          <?php $tuandui = current($mytuandui); ?>
              <div class="text-[14px] leading-[22px] text-black text-center font-['Roboto']" style="padding-top: 20%;
padding-bottom: 30%;background-image: url('<?php echo dr_get_file($tuandui); ?>');height: auto;background-size: cover;
background-repeat: no-repeat;">
                <?php $tuanduiwenzi=dr_site_value('tuanduiwenzi'); echo $tuanduiwenzi; ?>
                      </div>
              
              
            

          </div>
        </div>
      <footer class="relative">
        <div class="mx-auto relative">
          <?php $footerbg=dr_site_value('yjbjs');?>
          <article class="text-white pt-[110px] text-center" style="background-color:<?php echo $footerbg; ?>;height:auto;">
            <a href="/">
                 <?php $footimage=dr_site_value('yejiaozhutu'); $footimg = current($footimage); ?>
              <img src="<?php echo dr_get_file($footimg); ?>" alt="" class="">
            </a>
           
            <div class="justify-start left-[120px]" style="padding-top: 5%;padding-bottom: 5%;">
                
                <?php $twitter=dr_site_value('twitter'); $opensea=dr_site_value('opensea'); $discord=dr_site_value('discord');?>


              <a class="padding-10" target="_blank" href="<?php echo $twitter; ?>"><img src="/template/pc/default/home/static/image/tuite.png" alt=""></a>
              <a class="padding-10" target="_blank" href="<?php echo $discord; ?>"><img src="/template/pc/default/home/static/image/discord.png" alt=""></a>
              <a class="padding-10" target="_blank" href="<?php echo $opensea; ?>"><img src="/template/pc/default/home/static/image/OpenSea-fill.png" alt=""></a>
            </div>
            <div class="bottom-[100px] m-0 text-[20px] leading-[124px] text-black/[.5] tracking-wider font-light text-center" style="border-top: 1px solid #3c3c3c;color:#3c3c3c;font-weight:600;">?? 2022 CryptoDeer.inc</div>
          </article>
        </div>
      </footer>
      <script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
      <script src="/template/pc/default/home/static/js/index.js"></script>
  </body>
</html>