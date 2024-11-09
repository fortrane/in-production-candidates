<?php

class Templates
{
    public function documentHead($pageName)
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>В продакшен - Кандидаты | <?= $pageName; ?></title>
            <link rel="icon" sizes="16x16" type="image/svg" href="./public/img/favicon.svg">
            <script src="https://cdn.tailwindcss.com"></script>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="./public/css/in-prod.bundle.css">
            <?php
            switch ($pageName) {
                case 'My Cards':
            ?>
                    <link rel="stylesheet" href="./public/css/plugins/dropzone.min.css" />
                <?
                    break;

                case 'Find Candidate':
                ?>
                    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                <?
                    break;

                default:
                ?> <?
                        break;
                }
                        ?>
        </head>
    <?
    }

    public function documentJavascript($pageName)
    {

        $utilityClass = new UtilityClass();

    ?>
        <script src="./public/js/plugins/jquery-3.7.1.min.js"></script>
        <script src="./public/js/main.js"></script>
        <?php

        switch ($pageName) {
            case 'Sign In':
        ?>
                <script src="./public/js/pages/sign-in.js"></script>
                <?
                break;

            case 'Start':
                if ($utilityClass->getUsersAccessType() == "admin") {
                ?>
                    <script src="./public/js/pages/start.js"></script>
                <?
                }
                break;

            case 'Settings':
                ?>
                <script src="./public/js/pages/settings.js"></script>
            <?
                break;

            case 'All Cards':
            ?>
                <script src="./public/js/plugins/popper.min.js"></script>
                <script src="/public/js/plugins/tippy-bundle.umd.min.js"></script>
                <script src="./public/js/plugins/sweetalert.js"></script>
                <script src="./public/js/pages/all-cards.js"></script>
            <?
                break;

            case 'Users':
            ?>
                <script src="./public/js/plugins/sweetalert.js"></script>
                <script src="./public/js/pages/users.js"></script>
            <?
                break;

            case 'My Cards':
            ?>
                <script src="./public/js/plugins/popper.min.js"></script>
                <script src="/public/js/plugins/tippy-bundle.umd.min.js"></script>
                <script src="./public/js/plugins/sweetalert.js"></script>
                <script src="./public/js/plugins/dropzone.min.js"></script>
                <script src="./public/js/pages/my-cards.js"></script>
            <?
                break;

            case 'Find Candidate':
            ?>
                <script src="./public/js/plugins/popper.min.js"></script>
                <script src="/public/js/plugins/tippy-bundle.umd.min.js"></script>
                <script src="./public/js/plugins/sweetalert.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
                <script src="./public/js/pages/find-candidate.js"></script>
            <?php

            default:
            ?> <?php
                    break;
            }
        }

        public function inProdHeader($pageName)
        {

            $utilityClass = new UtilityClass();

                    ?>
        <header class="bg-white shadow-sm">
            <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    <div class="flex items-center">
                        <a href="/start">
                            <svg class="mx-auto h-8 w-auto hover:opacity-80 transition-opacity" xmlns="http://www.w3.org/2000/svg" width="115" height="32" viewBox="0 0 115 32" fill="none">
                                <g clip-path="url(#clip0_69_24)">
                                    <path d="M31.0254 17V6.97852H34.7852C35.5508 6.97852 36.1637 7.08105 36.624 7.28613C37.0889 7.48665 37.4512 7.79883 37.7109 8.22266C37.9753 8.64193 38.1074 9.08171 38.1074 9.54199C38.1074 9.97038 37.9912 10.3737 37.7588 10.752C37.5264 11.1302 37.1755 11.4355 36.7061 11.668C37.3122 11.8457 37.777 12.1488 38.1006 12.5771C38.4287 13.0055 38.5928 13.5114 38.5928 14.0947C38.5928 14.5641 38.4925 15.0016 38.292 15.4072C38.096 15.8083 37.8522 16.1182 37.5605 16.3369C37.2689 16.5557 36.902 16.722 36.46 16.8359C36.0225 16.9453 35.4847 17 34.8467 17H31.0254ZM32.3516 11.1895H34.5186C35.1064 11.1895 35.528 11.1507 35.7832 11.0732C36.1204 10.973 36.3734 10.8066 36.542 10.5742C36.7152 10.3418 36.8018 10.0501 36.8018 9.69922C36.8018 9.36654 36.722 9.07487 36.5625 8.82422C36.403 8.56901 36.1751 8.39583 35.8789 8.30469C35.5827 8.20898 35.0745 8.16113 34.3545 8.16113H32.3516V11.1895ZM32.3516 15.8174H34.8467C35.2751 15.8174 35.5758 15.8014 35.749 15.7695C36.0544 15.7148 36.3096 15.6237 36.5146 15.4961C36.7197 15.3685 36.8883 15.1839 37.0205 14.9424C37.1527 14.6963 37.2188 14.4137 37.2188 14.0947C37.2188 13.721 37.123 13.3975 36.9316 13.124C36.7402 12.846 36.4736 12.6523 36.1318 12.543C35.7946 12.429 35.307 12.3721 34.6689 12.3721H32.3516V15.8174ZM44.1641 9.74023H49.8926V17H48.6621V10.7588H45.3945V17H44.1641V9.74023ZM51.7451 19.7822V9.74023H52.8662V10.6836C53.1305 10.3145 53.429 10.0387 53.7617 9.85645C54.0944 9.6696 54.4977 9.57617 54.9717 9.57617C55.5915 9.57617 56.1383 9.73568 56.6123 10.0547C57.0863 10.3737 57.444 10.8249 57.6855 11.4082C57.9271 11.987 58.0479 12.6227 58.0479 13.3154C58.0479 14.0583 57.9134 14.7282 57.6445 15.3252C57.3802 15.9176 56.9928 16.3734 56.4824 16.6924C55.9766 17.0068 55.4434 17.1641 54.8828 17.1641C54.4727 17.1641 54.1035 17.0775 53.7754 16.9043C53.4518 16.7311 53.1852 16.5124 52.9756 16.248V19.7822H51.7451ZM52.8594 13.4111C52.8594 14.3454 53.0485 15.0358 53.4268 15.4824C53.805 15.929 54.263 16.1523 54.8008 16.1523C55.3477 16.1523 55.8148 15.9222 56.2021 15.4619C56.5941 14.9971 56.79 14.2793 56.79 13.3086C56.79 12.3835 56.5986 11.6908 56.2158 11.2305C55.8376 10.7702 55.3841 10.54 54.8555 10.54C54.3314 10.54 53.8665 10.7861 53.4609 11.2783C53.0599 11.766 52.8594 12.4769 52.8594 13.4111ZM59.0801 13.3701C59.0801 12.0257 59.4538 11.0299 60.2012 10.3828C60.8255 9.84505 61.5866 9.57617 62.4844 9.57617C63.4824 9.57617 64.2982 9.9043 64.9316 10.5605C65.5651 11.2122 65.8818 12.1146 65.8818 13.2676C65.8818 14.2018 65.7406 14.9378 65.458 15.4756C65.18 16.0088 64.7721 16.4235 64.2344 16.7197C63.7012 17.016 63.1178 17.1641 62.4844 17.1641C61.4681 17.1641 60.6455 16.8382 60.0166 16.1865C59.3923 15.5348 59.0801 14.596 59.0801 13.3701ZM60.3447 13.3701C60.3447 14.2998 60.5475 14.9971 60.9531 15.4619C61.3587 15.9222 61.8691 16.1523 62.4844 16.1523C63.0951 16.1523 63.6032 15.9199 64.0088 15.4551C64.4144 14.9902 64.6172 14.2816 64.6172 13.3291C64.6172 12.4313 64.4121 11.7523 64.002 11.292C63.5964 10.8271 63.0905 10.5947 62.4844 10.5947C61.8691 10.5947 61.3587 10.8249 60.9531 11.2852C60.5475 11.7454 60.3447 12.4404 60.3447 13.3701ZM67.9873 9.74023H73.0459V15.9883H73.832V19.0576H72.8203V17H67.1055V19.0576H66.0938V15.9883H66.7432C67.609 14.8125 68.0238 12.7298 67.9873 9.74023ZM69.0127 10.7588C68.9215 13.1149 68.557 14.8581 67.9189 15.9883H71.8223V10.7588H69.0127ZM79.9297 16.1045C79.474 16.4919 79.0342 16.7653 78.6104 16.9248C78.1911 17.0843 77.7399 17.1641 77.2568 17.1641C76.4593 17.1641 75.8464 16.9704 75.418 16.583C74.9896 16.1911 74.7754 15.6921 74.7754 15.0859C74.7754 14.7305 74.8551 14.4069 75.0146 14.1152C75.1787 13.819 75.3906 13.582 75.6504 13.4043C75.9147 13.2266 76.2109 13.0921 76.5391 13.001C76.7806 12.9372 77.1452 12.8757 77.6328 12.8164C78.6263 12.6979 79.3577 12.5566 79.8271 12.3926C79.8317 12.224 79.834 12.1169 79.834 12.0713C79.834 11.57 79.7178 11.2168 79.4854 11.0117C79.1709 10.7337 78.7038 10.5947 78.084 10.5947C77.5052 10.5947 77.0768 10.6973 76.7988 10.9023C76.5254 11.1029 76.3226 11.4606 76.1904 11.9756L74.9873 11.8115C75.0967 11.2965 75.2767 10.8818 75.5273 10.5674C75.778 10.2484 76.1403 10.0046 76.6143 9.83594C77.0882 9.66276 77.6374 9.57617 78.2617 9.57617C78.8815 9.57617 79.3851 9.64909 79.7725 9.79492C80.1598 9.94076 80.4447 10.1253 80.627 10.3486C80.8092 10.5674 80.9368 10.8454 81.0098 11.1826C81.0508 11.3923 81.0713 11.7705 81.0713 12.3174V13.958C81.0713 15.1019 81.0964 15.8265 81.1465 16.1318C81.2012 16.4326 81.306 16.722 81.4609 17H80.1758C80.0482 16.7448 79.9661 16.4463 79.9297 16.1045ZM79.8271 13.3564C79.3805 13.5387 78.7106 13.6937 77.8174 13.8213C77.3115 13.8942 76.9538 13.9762 76.7441 14.0674C76.5345 14.1585 76.3727 14.293 76.2588 14.4707C76.1449 14.6439 76.0879 14.8376 76.0879 15.0518C76.0879 15.3799 76.2109 15.6533 76.457 15.8721C76.7077 16.0908 77.0723 16.2002 77.5508 16.2002C78.0247 16.2002 78.4463 16.0977 78.8154 15.8926C79.1846 15.6829 79.4557 15.3981 79.6289 15.0381C79.7611 14.7601 79.8271 14.3499 79.8271 13.8076V13.3564ZM82.9785 9.74023H84.209V12.8779C84.6009 12.8779 84.8743 12.8027 85.0293 12.6523C85.1888 12.502 85.4212 12.0645 85.7266 11.3398C85.9681 10.7656 86.1641 10.3874 86.3145 10.2051C86.4648 10.0228 86.638 9.89974 86.834 9.83594C87.0299 9.77214 87.3444 9.74023 87.7773 9.74023H88.0234V10.7588L87.6816 10.752C87.3581 10.752 87.1507 10.7998 87.0596 10.8955C86.9639 10.9958 86.818 11.2943 86.6221 11.791C86.4352 12.265 86.2643 12.5931 86.1094 12.7754C85.9544 12.9577 85.7152 13.124 85.3916 13.2744C85.9202 13.4157 86.4398 13.9079 86.9502 14.751L88.2969 17H86.9434L85.6309 14.751C85.362 14.2998 85.1273 14.0036 84.9268 13.8623C84.7262 13.7165 84.487 13.6436 84.209 13.6436V17H82.9785V9.74023ZM89.1514 9.74023H90.3818V15.9814H93.1846V9.74023H94.415V15.9814H97.2246V9.74023H98.4482V17H89.1514V9.74023ZM105.318 14.6621L106.59 14.8193C106.389 15.5622 106.018 16.1387 105.476 16.5488C104.933 16.959 104.241 17.1641 103.397 17.1641C102.336 17.1641 101.493 16.8382 100.868 16.1865C100.248 15.5303 99.9385 14.612 99.9385 13.4316C99.9385 12.2103 100.253 11.2624 100.882 10.5879C101.511 9.91341 102.326 9.57617 103.329 9.57617C104.3 9.57617 105.093 9.90658 105.708 10.5674C106.323 11.2282 106.631 12.1579 106.631 13.3564C106.631 13.4294 106.629 13.5387 106.624 13.6846H101.21C101.256 14.4821 101.481 15.0928 101.887 15.5166C102.292 15.9404 102.798 16.1523 103.404 16.1523C103.855 16.1523 104.241 16.0339 104.56 15.7969C104.879 15.5599 105.132 15.1816 105.318 14.6621ZM101.278 12.6729H105.332C105.277 12.0622 105.122 11.6042 104.867 11.2988C104.475 10.8249 103.967 10.5879 103.343 10.5879C102.778 10.5879 102.301 10.777 101.914 11.1553C101.531 11.5335 101.319 12.0394 101.278 12.6729ZM108.148 9.74023H109.379V12.7617H112.79V9.74023H114.021V17H112.79V13.7803H109.379V17H108.148V9.74023Z" fill="#4F46E5"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M23.9996 12C23.9996 14.4406 23.271 16.711 22.0194 18.6056L5.39393 1.98015C7.28854 0.728598 9.55897 0 11.9996 0C18.627 0 23.9996 5.37258 23.9996 12ZM3.81221 3.22685L20.7727 20.1874C20.0981 20.9099 19.3353 21.5491 18.5015 22.0876L1.91193 5.49814C2.4505 4.66428 3.08964 3.90146 3.81221 3.22685ZM11.5781 23.9927L0.00683594 12.4215C0.224039 18.7138 5.28576 23.7755 11.5781 23.9927ZM14.2106 23.7967C15.0587 23.6388 15.8754 23.3916 16.6507 23.0653L0.934232 7.34887C0.607961 8.12416 0.360791 8.94092 0.202828 9.78904L14.2106 23.7967Z" fill="#4F46E5"></path>
                                </g>
                                <path d="M60.8064 29V21.65H61.5729V27.74L66.2769 21.65H66.9804V29H66.2139V22.9205L61.5099 29H60.8064ZM70.9202 29V22.112L71.1302 22.322H68.3372V21.65H74.2697V22.322H71.4872L71.6867 22.112V29H70.9202ZM74.6862 26.48V25.829H77.4372V26.48H74.6862ZM81.5385 29.0525C80.9925 29.0525 80.5025 28.9335 80.0685 28.6955C79.6415 28.4505 79.3055 28.118 79.0605 27.698C78.8155 27.271 78.693 26.7845 78.693 26.2385C78.693 25.6855 78.8155 25.199 79.0605 24.779C79.3055 24.359 79.6415 24.03 80.0685 23.792C80.5025 23.554 80.9925 23.435 81.5385 23.435C82.0075 23.435 82.431 23.526 82.809 23.708C83.187 23.89 83.4845 24.163 83.7015 24.527L83.145 24.905C82.956 24.625 82.7215 24.4185 82.4415 24.2855C82.1615 24.1525 81.857 24.086 81.528 24.086C81.136 24.086 80.7825 24.177 80.4675 24.359C80.1525 24.534 79.904 24.7825 79.722 25.1045C79.54 25.4265 79.449 25.8045 79.449 26.2385C79.449 26.6725 79.54 27.0505 79.722 27.3725C79.904 27.6945 80.1525 27.9465 80.4675 28.1285C80.7825 28.3035 81.136 28.391 81.528 28.391C81.857 28.391 82.1615 28.3245 82.4415 28.1915C82.7215 28.0585 82.956 27.8555 83.145 27.5825L83.7015 27.9605C83.4845 28.3175 83.187 28.5905 82.809 28.7795C82.431 28.9615 82.0075 29.0525 81.5385 29.0525ZM86.0924 29V23.939L86.2814 24.1385H84.0029V23.4875H88.9274V24.1385H86.6489L86.8379 23.939V29H86.0924ZM90.0998 31.0895C89.8408 31.0895 89.5923 31.0475 89.3543 30.9635C89.1233 30.8795 88.9238 30.7535 88.7558 30.5855L89.1023 30.029C89.2423 30.162 89.3928 30.2635 89.5538 30.3335C89.7218 30.4105 89.9073 30.449 90.1103 30.449C90.3553 30.449 90.5653 30.379 90.7403 30.239C90.9223 30.106 91.0938 29.868 91.2548 29.525L91.6118 28.7165L91.6958 28.601L93.9638 23.4875H94.6988L91.9373 29.6615C91.7833 30.0185 91.6118 30.302 91.4228 30.512C91.2408 30.722 91.0413 30.869 90.8243 30.953C90.6073 31.044 90.3658 31.0895 90.0998 31.0895ZM91.5698 29.1575L89.0288 23.4875H89.8058L92.0528 28.5485L91.5698 29.1575ZM99.4045 28.643V24.1385H96.748L96.685 25.367C96.671 25.738 96.6465 26.102 96.6115 26.459C96.5835 26.816 96.531 27.145 96.454 27.446C96.384 27.74 96.2825 27.9815 96.1495 28.1705C96.0165 28.3525 95.845 28.4575 95.635 28.4855L94.8895 28.349C95.1065 28.356 95.285 28.279 95.425 28.118C95.565 27.95 95.6735 27.7225 95.7505 27.4355C95.8275 27.1485 95.8835 26.823 95.9185 26.459C95.9535 26.088 95.9815 25.71 96.0025 25.325L96.076 23.4875H100.15V28.643H99.4045ZM94.6585 30.3335V28.349H101.011V30.3335H100.307V29H95.362V30.3335H94.6585ZM102.464 29V23.4875H103.209V27.866L106.895 23.4875H107.556V29H106.811V24.611L103.136 29H102.464ZM113.252 29V27.0155L113.389 27.173H111.52C110.813 27.173 110.26 27.019 109.861 26.711C109.462 26.403 109.262 25.955 109.262 25.367C109.262 24.737 109.476 24.268 109.903 23.96C110.33 23.645 110.9 23.4875 111.614 23.4875H113.935V29H113.252ZM109.22 29L110.732 26.879H111.509L110.029 29H109.22ZM113.252 26.795V23.918L113.389 24.1385H111.635C111.124 24.1385 110.725 24.2365 110.438 24.4325C110.158 24.6285 110.018 24.947 110.018 25.388C110.018 26.207 110.54 26.6165 111.583 26.6165H113.389L113.252 26.795Z" fill="#4F46E5" fill-opacity="0.8"></path>
                                <defs>
                                    <clipPath id="clip0_69_24">
                                        <rect width="115" height="24" fill="#4F46E5"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>

                    <div class="hidden lg:flex lg:gap-x-6">
                        <a href="/start" class="inline-flex items-center px-3 py-2 text-sm font-medium <?php if ($pageName == "Start") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:text-indigo-600">
                            Домашная страница
                        </a>
                        <a href="/my-cards" class="inline-flex items-center px-3 py-2 text-sm font-medium <?php if ($pageName == "My Cards") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:text-indigo-600">
                            Мои визитки
                        </a>
                        <?php
                        if ($utilityClass->getUsersAccessType() == "admin") {
                        ?>
                            <a href="/all-cards" class="inline-flex items-center px-3 py-2 text-sm font-medium <?php if ($pageName == "All Cards") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:text-indigo-600">
                                Все визитки
                            </a>
                            <a href="/find-candidate" class="inline-flex items-center px-3 py-2 text-sm font-medium <?php if ($pageName == "Find Candidate") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:text-indigo-600">
                                Найти сотрудника
                            </a>
                            <a href="/users" class="inline-flex items-center px-3 py-2 text-sm font-medium <?php if ($pageName == "Users") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:text-indigo-600">
                                Пользователи
                            </a>
                        <?php
                        }
                        ?>
                        <a href="/settings" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 <?php if ($pageName == "Settings") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> hover:text-indigo-600">
                            Настройки
                        </a>
                    </div>

                    <div class="lg:flex hidden items-center gap-x-2">
                        <a href="/logout" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 !text-rose-600 !rounded-md !bg-rose-50 hover:text-rose-600">
                            Выход
                        </a>
                    </div>

                    <div class="flex lg:hidden">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mobile-menu hidden md:hidden pb-3">
                    <div class="space-y-1 px-2 border-t border-gray-200 pt-3">
                        <a href="/start" class="block rounded-md px-3 py-2 text-base font-medium <?php if ($pageName == "Start") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:bg-gray-100">
                            Домашная страница
                        </a>
                        <a href="/my-cards" class="block rounded-md px-3 py-2 text-base font-medium <?php if ($pageName == "My Cards") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:bg-gray-100">
                            Мои Заявки
                        </a>
                        <?php
                        if ($utilityClass->getUsersAccessType() == "admin") {
                        ?>
                            <a href="/all-cards" class="block rounded-md px-3 py-2 text-base font-medium <?php if ($pageName == "All Cards") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:bg-gray-100">
                                Все визитки
                            </a>
                            <a href="/find-candidate" class="block rounded-md px-3 py-2 text-base font-medium <?php if ($pageName == "Find Candidate") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:bg-gray-100">
                                Найти сотрудника
                            </a>
                            <a href="/users" class="block rounded-md px-3 py-2 text-base font-medium <?php if ($pageName == "Users") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:bg-gray-100">
                                Пользователи
                            </a>
                        <?php
                        }
                        ?>
                        <a href="/settings" class="block rounded-md px-3 py-2 text-base font-medium <?php if ($pageName == "Settings") { ?>!text-indigo-600 !rounded-md !bg-indigo-50<?php } ?> text-gray-700 hover:bg-gray-100">
                            Настройки
                        </a>
                        <a href="/logout" class="block rounded-md px-3 py-2 text-base font-medium !text-rose-600 !rounded-md !bg-rose-50 hover:text-rose-600">
                            Выход
                        </a>
                    </div>
                </div>
            </nav>
        </header>
    <?php
        }

        public function inProdFooter()
        {
    ?>
        <footer class="bg-white">
            <div class="mx-auto max-w-7xl px-6 py-12 md:flex md:items-center md:justify-between lg:px-8">
                <div class="mt-8 md:order-1 md:mt-0">
                    <p class="text-center text-xs leading-5 text-gray-500">
                        &copy; <?php echo (date("Y")); ?> В продакшен. Все права защищены.
                    </p>
                </div>
            </div>
        </footer>
        <?
        }

        public function inProdStart()
        {
            $utilityClass = new UtilityClass();

            if ($utilityClass->getUsersAccessType() == "admin") {

        ?>
            <main>
                <div class="relative isolate overflow-hidden bg-white">
                    <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
                        <defs>
                            <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M0 .5H40M.5 0V40" fill="none" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)" />
                    </svg>
                    <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-20">
                        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-8">
                            <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                                Добро пожаловать
                            </h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                Управляйте кандидатами, находите сотрудников и отслеживайте статистику в одном месте!
                            </p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <a href="/find-candidate" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Найти сотрудника
                                </a>
                                <a href="/all-cards" class="text-sm font-semibold leading-6 text-gray-900">
                                    Все визитки <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                        <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-0 lg:max-w-none lg:flex-none xl:ml-32">
                            <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                                <img src="./public/img/hero.svg" class="sm:w-[32rem] w-[24rem] rounded-md">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white py-12">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-gray-600">Всего визиток</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl all-cards">0</dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-gray-600">Визиток за месяц</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl cards-in-month">0</dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                                <dt class="text-base leading-7 text-gray-600">Сотрудников в системе</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl candidates-in-system">0</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </main>
        <?
            } else {
        ?>
            <main>
                <div class="relative isolate overflow-hidden bg-white">
                    <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
                        <defs>
                            <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M0 .5H40M.5 0V40" fill="none" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)" />
                    </svg>
                    <div class="mx-auto max-w-7xl px-6 pb-24 pt-10 sm:pb-32 lg:flex lg:px-8 lg:py-20">
                        <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-xl lg:flex-shrink-0 lg:pt-8">
                            <h1 class="mt-10 text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                                Добро пожаловать
                            </h1>
                            <p class="mt-6 text-lg leading-8 text-gray-600">
                                Раскройте свой потенциал, найдите идеальную профессию и отслеживайте свое развитие в одном месте!
                            </p>
                            <div class="mt-10 flex items-center gap-x-6">
                                <a href="/find-candidate" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    Мои визитки
                                </a>
                            </div>
                        </div>
                        <div class="mx-auto mt-16 flex max-w-2xl sm:mt-24 lg:ml-10 lg:mr-0 lg:mt-0 lg:max-w-none lg:flex-none xl:ml-32">
                            <div class="max-w-3xl flex-none sm:max-w-5xl lg:max-w-none">
                                <img src="./public/img/hero.svg" class="sm:w-[32rem] w-[24rem] rounded-md">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
<?
            }
        }
    }
