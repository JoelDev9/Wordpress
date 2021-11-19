/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referring to this file must be placed before the ending body tag. */

/* Use conditional comments in order to target IE 7 and older:
	<!--[if lt IE 8]><!-->
	<script src="ie7/ie7.js"></script>
	<!--<![endif]-->
*/

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'Icons\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-zynga': '&#xe600;',
		'icon-zootool': '&#xe601;',
		'icon-zoom-out': '&#xe602;',
		'icon-zoom-in': '&#xe603;',
		'icon-zerply': '&#xe604;',
		'icon-youtube': '&#xe605;',
		'icon-youtube_alt': '&#xe606;',
		'icon-yelp': '&#xe607;',
		'icon-yahoo': '&#xe608;',
		'icon-yahoo_messenger': '&#xe609;',
		'icon-yahoo_buzz': '&#xe60a;',
		'icon-xing': '&#xe60b;',
		'icon-wrench': '&#xe60c;',
		'icon-wordpress': '&#xe60d;',
		'icon-wordpress_alt': '&#xe60e;',
		'icon-wists': '&#xe60f;',
		'icon-wink': '&#xe610;',
		'icon-windows': '&#xe611;',
		'icon-wikipedia': '&#xe612;',
		'icon-wifi-symbol-2': '&#xe613;',
		'icon-wifi-symbol-1': '&#xe614;',
		'icon-wifi-signal-normal': '&#xe615;',
		'icon-wifi-signal-medium-3': '&#xe616;',
		'icon-wifi-signal-medium-2': '&#xe617;',
		'icon-wifi-signal-medium-1': '&#xe618;',
		'icon-wifi-signal-low': '&#xe619;',
		'icon-wifi-signal-low-3': '&#xe61a;',
		'icon-wifi-signal-low-2': '&#xe61b;',
		'icon-wifi-signal-low-1': '&#xe61c;',
		'icon-wifi-signal-full-3': '&#xe61d;',
		'icon-wifi-signal-full-2': '&#xe61e;',
		'icon-wifi-signal-full-1': '&#xe61f;',
		'icon-whatsapp': '&#xe620;',
		'icon-websiteoptimization': '&#xe621;',
		'icon-websiteoptimization3': '&#xe622;',
		'icon-websiteoptimization2': '&#xe623;',
		'icon-websitedesign': '&#xe624;',
		'icon-websitedesign3': '&#xe625;',
		'icon-websitedesign2': '&#xe626;',
		'icon-watch-4': '&#xe627;',
		'icon-watch-3': '&#xe628;',
		'icon-watch-2': '&#xe629;',
		'icon-watch-1': '&#xe62a;',
		'icon-warning': '&#xe62b;',
		'icon-warning-3': '&#xe62c;',
		'icon-warning-2': '&#xe62d;',
		'icon-w3': '&#xe62e;',
		'icon-volume-up': '&#xe62f;',
		'icon-volume-mute': '&#xe630;',
		'icon-volume-min': '&#xe631;',
		'icon-volume-max': '&#xe632;',
		'icon-volume-down': '&#xe633;',
		'icon-virb': '&#xe634;',
		'icon-vimeo': '&#xe635;',
		'icon-video-camera-10': '&#xe636;',
		'icon-video-camera-9': '&#xe637;',
		'icon-video-camera-8': '&#xe638;',
		'icon-video-camera-7': '&#xe639;',
		'icon-video-camera-6': '&#xe63a;',
		'icon-video-camera-5': '&#xe63b;',
		'icon-video-camera-4': '&#xe63c;',
		'icon-video-camera-3': '&#xe63d;',
		'icon-video-camera-2': '&#xe63e;',
		'icon-video-camera-1': '&#xe63f;',
		'icon-videomarketing': '&#xe640;',
		'icon-videomarketing3': '&#xe641;',
		'icon-videomarketing2': '&#xe642;',
		'icon-viddler': '&#xe643;',
		'icon-vector-path-square': '&#xe644;',
		'icon-vector-path-line': '&#xe645;',
		'icon-vector-path-curve': '&#xe646;',
		'icon-vector-path-circle': '&#xe647;',
		'icon-vcard': '&#xe648;',
		'icon-users': '&#xe649;',
		'icon-users-2': '&#xe64a;',
		'icon-users-1': '&#xe64b;',
		'icon-user1': '&#xe64c;',
		'icon-user': '&#xe64d;',
		'icon-user-6': '&#xe64e;',
		'icon-user-5': '&#xe64f;',
		'icon-user-4': '&#xe650;',
		'icon-user-3': '&#xe651;',
		'icon-user-2': '&#xe652;',
		'icon-user-1': '&#xe653;',
		'icon-upset': '&#xe654;',
		'icon-unsure': '&#xe655;',
		'icon-unlike': '&#xe656;',
		'icon-undo-7': '&#xe657;',
		'icon-undo-6': '&#xe658;',
		'icon-undo-5': '&#xe659;',
		'icon-undo-4': '&#xe65a;',
		'icon-undo-3': '&#xe65b;',
		'icon-undo-2': '&#xe65c;',
		'icon-undo-1': '&#xe65d;',
		'icon-underwater-camera': '&#xe65e;',
		'icon-umbrella': '&#xe65f;',
		'icon-umbrella-rain': '&#xe660;',
		'icon-twitter': '&#xe661;',
		'icon-twitter_alt': '&#xe662;',
		'icon-tumblr': '&#xe663;',
		'icon-tripod': '&#xe664;',
		'icon-tripit': '&#xe665;',
		'icon-tribenet': '&#xe666;',
		'icon-trash': '&#xe667;',
		'icon-town-tower-2': '&#xe668;',
		'icon-town-tower-1': '&#xe669;',
		'icon-tongue': '&#xe66a;',
		'icon-threewordsme': '&#xe66b;',
		'icon-technorati': '&#xe66c;',
		'icon-targetaudience': '&#xe66d;',
		'icon-targetaudience3': '&#xe66e;',
		'icon-targetaudience2': '&#xe66f;',
		'icon-tag': '&#xe670;',
		'icon-tag-3': '&#xe671;',
		'icon-tag-2': '&#xe672;',
		'icon-tablet-3': '&#xe673;',
		'icon-tablet-2': '&#xe674;',
		'icon-tablet-1': '&#xe675;',
		'icon-surprised': '&#xe676;',
		'icon-sunbathing': '&#xe677;',
		'icon-sunbathing-2': '&#xe678;',
		'icon-stumbleupon': '&#xe679;',
		'icon-storm': '&#xe67a;',
		'icon-stopwatch-2': '&#xe67b;',
		'icon-stopwatch-1': '&#xe67c;',
		'icon-steam': '&#xe67d;',
		'icon-star': '&#xe67e;',
		'icon-squint': '&#xe67f;',
		'icon-squidoo': '&#xe680;',
		'icon-squarespace': '&#xe681;',
		'icon-spotify': '&#xe682;',
		'icon-soundcloud': '&#xe683;',
		'icon-snow': '&#xe684;',
		'icon-smugmug': '&#xe685;',
		'icon-smooking': '&#xe686;',
		'icon-smile': '&#xe687;',
		'icon-slideshare': '&#xe688;',
		'icon-slashdot': '&#xe689;',
		'icon-skype': '&#xe68a;',
		'icon-simplenote': '&#xe68b;',
		'icon-signal': '&#xe68c;',
		'icon-signal-tower-6': '&#xe68d;',
		'icon-signal-tower-5': '&#xe68e;',
		'icon-signal-tower-4': '&#xe68f;',
		'icon-signal-tower-3': '&#xe690;',
		'icon-signal-tower-2': '&#xe691;',
		'icon-signal-tower-1': '&#xe692;',
		'icon-signal-31': '&#xe693;',
		'icon-signal-21': '&#xe694;',
		'icon-signal-4': '&#xe695;',
		'icon-signal-3': '&#xe696;',
		'icon-signal-2': '&#xe697;',
		'icon-signal-1': '&#xe698;',
		'icon-shuffle': '&#xe699;',
		'icon-shopping-cart': '&#xe69a;',
		'icon-Shopping-Cart-17': '&#xe69b;',
		'icon-Shopping-Cart-16': '&#xe69c;',
		'icon-Shopping-Cart-15': '&#xe69d;',
		'icon-Shopping-Cart-14': '&#xe69e;',
		'icon-Shopping-Cart-13': '&#xe69f;',
		'icon-Shopping-Cart-12': '&#xe6a0;',
		'icon-Shopping-Cart-11': '&#xe6a1;',
		'icon-Shopping-Cart-10': '&#xe6a2;',
		'icon-Shopping-Cart-9': '&#xe6a3;',
		'icon-shopping-cart-8': '&#xe6a4;',
		'icon-shopping-cart-7': '&#xe6a5;',
		'icon-shopping-cart-6': '&#xe6a6;',
		'icon-shopping-cart-5': '&#xe6a7;',
		'icon-shopping-cart-4': '&#xe6a8;',
		'icon-shopping-cart-3': '&#xe6a9;',
		'icon-shopping-cart-2': '&#xe6aa;',
		'icon-shopping-cart-1': '&#xe6ab;',
		'icon-shop-5': '&#xe6ac;',
		'icon-shop-4': '&#xe6ad;',
		'icon-shop-3': '&#xe6ae;',
		'icon-shop-2': '&#xe6af;',
		'icon-shop-1': '&#xe6b0;',
		'icon-sharethis': '&#xe6b1;',
		'icon-setting': '&#xe6b2;',
		'icon-seotips': '&#xe6b3;',
		'icon-seotips3': '&#xe6b4;',
		'icon-seotips2': '&#xe6b5;',
		'icon-seotag': '&#xe6b6;',
		'icon-seotag3': '&#xe6b7;',
		'icon-seotag2': '&#xe6b8;',
		'icon-seoperformance': '&#xe6b9;',
		'icon-seoperformance3': '&#xe6ba;',
		'icon-seoperformance2': '&#xe6bb;',
		'icon-sent-mail-3': '&#xe6bc;',
		'icon-sent-mail-2': '&#xe6bd;',
		'icon-sent-mail-1': '&#xe6be;',
		'icon-search': '&#xe6bf;',
		'icon-sd-card': '&#xe6c0;',
		'icon-scribd': '&#xe6c1;',
		'icon-screwdriver': '&#xe6c2;',
		'icon-screen-4': '&#xe6c3;',
		'icon-screen-3': '&#xe6c4;',
		'icon-screen-2': '&#xe6c5;',
		'icon-screen-1': '&#xe6c6;',
		'icon-sand-watch-4': '&#xe6c7;',
		'icon-sand-watch-3': '&#xe6c8;',
		'icon-sand-watch-2': '&#xe6c9;',
		'icon-sand-watch-1': '&#xe6ca;',
		'icon-sad': '&#xe6cb;',
		'icon-rugby': '&#xe6cc;',
		'icon-rss': '&#xe6cd;',
		'icon-roll-film': '&#xe6ce;',
		'icon-roll-film-2': '&#xe6cf;',
		'icon-roll-film-1': '&#xe6d0;',
		'icon-rocket': '&#xe6d1;',
		'icon-roboto': '&#xe6d2;',
		'icon-retweet': '&#xe6d3;',
		'icon-retweet-2': '&#xe6d4;',
		'icon-retweet2': '&#xe6d5;',
		'icon-responsive-design': '&#xe6d6;',
		'icon-remove-user': '&#xe6d7;',
		'icon-remove-tag': '&#xe6d8;',
		'icon-remove-location': '&#xe6d9;',
		'icon-refresh': '&#xe6da;',
		'icon-redo-7': '&#xe6db;',
		'icon-redo-6': '&#xe6dc;',
		'icon-redo-5': '&#xe6dd;',
		'icon-redo-4': '&#xe6de;',
		'icon-redo-3': '&#xe6df;',
		'icon-redo-2': '&#xe6e0;',
		'icon-redo-1': '&#xe6e1;',
		'icon-reddit': '&#xe6e2;',
		'icon-receipt-9': '&#xe6e3;',
		'icon-receipt-8': '&#xe6e4;',
		'icon-receipt-7': '&#xe6e5;',
		'icon-receipt-6': '&#xe6e6;',
		'icon-receipt-5': '&#xe6e7;',
		'icon-receipt-4': '&#xe6e8;',
		'icon-receipt-3': '&#xe6e9;',
		'icon-receipt-2': '&#xe6ea;',
		'icon-receipt-1': '&#xe6eb;',
		'icon-readernaut': '&#xe6ec;',
		'icon-rdio': '&#xe6ed;',
		'icon-rain': '&#xe6ee;',
		'icon-radar': '&#xe6ef;',
		'icon-radar-5': '&#xe6f0;',
		'icon-radar-4': '&#xe6f1;',
		'icon-radar-3': '&#xe6f2;',
		'icon-radar-2': '&#xe6f3;',
		'icon-quora': '&#xe6f4;',
		'icon-quill-4': '&#xe6f5;',
		'icon-quill-3': '&#xe6f6;',
		'icon-quill-2': '&#xe6f7;',
		'icon-quill-1': '&#xe6f8;',
		'icon-quik': '&#xe6f9;',
		'icon-printer-11': '&#xe6fa;',
		'icon-printer-10': '&#xe6fb;',
		'icon-printer-9': '&#xe6fc;',
		'icon-printer-8': '&#xe6fd;',
		'icon-printer-7': '&#xe6fe;',
		'icon-printer-6': '&#xe6ff;',
		'icon-printer-5': '&#xe700;',
		'icon-printer-4': '&#xe701;',
		'icon-printer-3': '&#xe702;',
		'icon-printer-2': '&#xe703;',
		'icon-printer-1': '&#xe704;',
		'icon-presentation': '&#xe705;',
		'icon-power-symbol-16': '&#xe706;',
		'icon-power-symbol-15': '&#xe707;',
		'icon-power-symbol-14': '&#xe708;',
		'icon-power-symbol-13': '&#xe709;',
		'icon-power-symbol-12': '&#xe70a;',
		'icon-power-symbol-11': '&#xe70b;',
		'icon-power-symbol-10': '&#xe70c;',
		'icon-power-symbol-9': '&#xe70d;',
		'icon-power-symbol-8': '&#xe70e;',
		'icon-power-symbol-7': '&#xe70f;',
		'icon-power-symbol-6': '&#xe710;',
		'icon-powe-symbol-5': '&#xe711;',
		'icon-powe-symbol-4': '&#xe712;',
		'icon-powe-symbol-3': '&#xe713;',
		'icon-powe-symbol-2': '&#xe714;',
		'icon-powe-symbol-1': '&#xe715;',
		'icon-posterous': '&#xe716;',
		'icon-podcast': '&#xe717;',
		'icon-plurk': '&#xe718;',
		'icon-plixi': '&#xe719;',
		'icon-playstation': '&#xe71a;',
		'icon-playlist': '&#xe71b;',
		'icon-pingchat': '&#xe71c;',
		'icon-ping': '&#xe71d;',
		'icon-pinboardin': '&#xe71e;',
		'icon-pin': '&#xe71f;',
		'icon-pin-2': '&#xe720;',
		'icon-pie-chart-12': '&#xe721;',
		'icon-pie-chart-11': '&#xe722;',
		'icon-pie-chart-10': '&#xe723;',
		'icon-pie-chart-9': '&#xe724;',
		'icon-pie-chart-8': '&#xe725;',
		'icon-pie-chart-7': '&#xe726;',
		'icon-pie-chart-6': '&#xe727;',
		'icon-pie-chart-5': '&#xe728;',
		'icon-pie-chart-4': '&#xe729;',
		'icon-pie-chart-3': '&#xe72a;',
		'icon-pie-chart-2': '&#xe72b;',
		'icon-pie-chart-1': '&#xe72c;',
		'icon-picture': '&#xe72d;',
		'icon-picassa': '&#xe72e;',
		'icon-photobucket': '&#xe72f;',
		'icon-phone-waiting': '&#xe730;',
		'icon-phone-volume': '&#xe731;',
		'icon-phone-symbol-4': '&#xe732;',
		'icon-phone-symbol-3': '&#xe733;',
		'icon-phone-symbol-2': '&#xe734;',
		'icon-phone-symbol-1': '&#xe735;',
		'icon-phone-support': '&#xe736;',
		'icon-phone-remove': '&#xe737;',
		'icon-phone-out': '&#xe738;',
		'icon-phone-lock': '&#xe739;',
		'icon-phone-in': '&#xe73a;',
		'icon-phone-book': '&#xe73b;',
		'icon-phone-block': '&#xe73c;',
		'icon-phone-add': '&#xe73d;',
		'icon-phone-6': '&#xe73e;',
		'icon-phone-5': '&#xe73f;',
		'icon-phone-4': '&#xe740;',
		'icon-phone-3': '&#xe741;',
		'icon-phone-2': '&#xe742;',
		'icon-phone-1': '&#xe743;',
		'icon-pencil': '&#xe744;',
		'icon-pen-15': '&#xe745;',
		'icon-pen-14': '&#xe746;',
		'icon-pen-13': '&#xe747;',
		'icon-pen-12': '&#xe748;',
		'icon-pen-11': '&#xe749;',
		'icon-pen-10': '&#xe74a;',
		'icon-pen-9': '&#xe74b;',
		'icon-pen-8': '&#xe74c;',
		'icon-pen-7': '&#xe74d;',
		'icon-pen-6': '&#xe74e;',
		'icon-pen-5': '&#xe74f;',
		'icon-pen-4': '&#xe750;',
		'icon-pen-3': '&#xe751;',
		'icon-pen-2': '&#xe752;',
		'icon-pen-1': '&#xe753;',
		'icon-pc': '&#xe754;',
		'icon-paypal': '&#xe755;',
		'icon-payperclickoptimization': '&#xe756;',
		'icon-payperclickoptimization3': '&#xe757;',
		'icon-payperclickoptimization2': '&#xe758;',
		'icon-path': '&#xe759;',
		'icon-path2': '&#xe75a;',
		'icon-paperclip': '&#xe75b;',
		'icon-paper-clip-8': '&#xe75c;',
		'icon-paper-clip-7': '&#xe75d;',
		'icon-paper-clip-6': '&#xe75e;',
		'icon-paper-clip-5': '&#xe75f;',
		'icon-paper-clip-4': '&#xe760;',
		'icon-paper-clip-3': '&#xe761;',
		'icon-paper-clip-2': '&#xe762;',
		'icon-paper-clip-1': '&#xe763;',
		'icon-pandora': '&#xe764;',
		'icon-palm-tree': '&#xe765;',
		'icon-paintbrush': '&#xe766;',
		'icon-pagespeed': '&#xe767;',
		'icon-pagespeed3': '&#xe768;',
		'icon-pagespeed2': '&#xe769;',
		'icon-pagequality': '&#xe76a;',
		'icon-pagequality3': '&#xe76b;',
		'icon-pagequality2': '&#xe76c;',
		'icon-orkut': '&#xe76d;',
		'icon-openid': '&#xe76e;',
		'icon-officialfm': '&#xe76f;',
		'icon-note': '&#xe770;',
		'icon-note-21': '&#xe771;',
		'icon-note-11': '&#xe772;',
		'icon-note-10': '&#xe773;',
		'icon-note-9': '&#xe774;',
		'icon-note-8': '&#xe775;',
		'icon-note-7': '&#xe776;',
		'icon-note-6': '&#xe777;',
		'icon-note-5': '&#xe778;',
		'icon-note-4': '&#xe779;',
		'icon-note-3': '&#xe77a;',
		'icon-note-2': '&#xe77b;',
		'icon-note-1': '&#xe77c;',
		'icon-no-smooking': '&#xe77d;',
		'icon-no-flash': '&#xe77e;',
		'icon-newsvine': '&#xe77f;',
		'icon-new-email': '&#xe780;',
		'icon-navigation': '&#xe781;',
		'icon-navigation-2': '&#xe782;',
		'icon-myspace': '&#xe783;',
		'icon-myspace_alt': '&#xe784;',
		'icon-music-note-8': '&#xe785;',
		'icon-music-note-7': '&#xe786;',
		'icon-music-note-6': '&#xe787;',
		'icon-music-note-5': '&#xe788;',
		'icon-music-note-4': '&#xe789;',
		'icon-music-note-3': '&#xe78a;',
		'icon-music-note-2': '&#xe78b;',
		'icon-music-note-1': '&#xe78c;',
		'icon-multy-user': '&#xe78d;',
		'icon-msn_messenger': '&#xe78e;',
		'icon-movie-4': '&#xe78f;',
		'icon-movie-3': '&#xe790;',
		'icon-movie-2': '&#xe791;',
		'icon-movie-1': '&#xe792;',
		'icon-mouse': '&#xe793;',
		'icon-money-bag-8': '&#xe794;',
		'icon-money-bag-7': '&#xe795;',
		'icon-money-bag-6': '&#xe796;',
		'icon-money-bag-5': '&#xe797;',
		'icon-money-bag-4': '&#xe798;',
		'icon-money-bag-3': '&#xe799;',
		'icon-money-bag-2': '&#xe79a;',
		'icon-money-bag-1': '&#xe79b;',
		'icon-money-8': '&#xe79c;',
		'icon-money-7': '&#xe79d;',
		'icon-money-6': '&#xe79e;',
		'icon-money-5': '&#xe79f;',
		'icon-money-4': '&#xe7a0;',
		'icon-money-3': '&#xe7a1;',
		'icon-money-2': '&#xe7a2;',
		'icon-money-1': '&#xe7a3;',
		'icon-mobileme': '&#xe7a4;',
		'icon-mobile-3': '&#xe7a5;',
		'icon-mobile-2': '&#xe7a6;',
		'icon-mobile-1': '&#xe7a7;',
		'icon-mobilemarketing': '&#xe7a8;',
		'icon-mobilemarketing3': '&#xe7a9;',
		'icon-mobilemarketing2': '&#xe7aa;',
		'icon-mixx': '&#xe7ab;',
		'icon-mixx_alt': '&#xe7ac;',
		'icon-mister_wong': '&#xe7ad;',
		'icon-ming': '&#xe7ae;',
		'icon-mic-10': '&#xe7af;',
		'icon-mic-9': '&#xe7b0;',
		'icon-mic-8': '&#xe7b1;',
		'icon-mic-7': '&#xe7b2;',
		'icon-mic-6': '&#xe7b3;',
		'icon-mic-5': '&#xe7b4;',
		'icon-mic-4': '&#xe7b5;',
		'icon-mic-3': '&#xe7b6;',
		'icon-mic-2': '&#xe7b7;',
		'icon-mic-1': '&#xe7b8;',
		'icon-metacafe': '&#xe7b9;',
		'icon-meetup': '&#xe7ba;',
		'icon-map-marker-20': '&#xe7bb;',
		'icon-map-marker-19': '&#xe7bc;',
		'icon-map-marker-18': '&#xe7bd;',
		'icon-map-marker-17': '&#xe7be;',
		'icon-map-marker-16': '&#xe7bf;',
		'icon-map-marker-15': '&#xe7c0;',
		'icon-map-marker-14': '&#xe7c1;',
		'icon-map-marker-13': '&#xe7c2;',
		'icon-map-marker-12': '&#xe7c3;',
		'icon-map-marker-11': '&#xe7c4;',
		'icon-map-marker-10': '&#xe7c5;',
		'icon-map-marker-9': '&#xe7c6;',
		'icon-map-marker-8': '&#xe7c7;',
		'icon-map-marker-7': '&#xe7c8;',
		'icon-map-marker-6': '&#xe7c9;',
		'icon-map-marker-5': '&#xe7ca;',
		'icon-map-marker-4': '&#xe7cb;',
		'icon-map-marker-3': '&#xe7cc;',
		'icon-map-marker-2': '&#xe7cd;',
		'icon-map-marker-1': '&#xe7ce;',
		'icon-map-10': '&#xe7cf;',
		'icon-map-9': '&#xe7d0;',
		'icon-map-8': '&#xe7d1;',
		'icon-map-7': '&#xe7d2;',
		'icon-map-6': '&#xe7d3;',
		'icon-map-5': '&#xe7d4;',
		'icon-map-4': '&#xe7d5;',
		'icon-map-3': '&#xe7d6;',
		'icon-map-2': '&#xe7d7;',
		'icon-map-1': '&#xe7d8;',
		'icon-mailbox-8': '&#xe7d9;',
		'icon-mailbox-7': '&#xe7da;',
		'icon-mailbox-6': '&#xe7db;',
		'icon-mailbox-5': '&#xe7dc;',
		'icon-mailbox-4': '&#xe7dd;',
		'icon-mailbox-3': '&#xe7de;',
		'icon-mailbox-2': '&#xe7df;',
		'icon-mailbox-1': '&#xe7e0;',
		'icon-mail-upload': '&#xe7e1;',
		'icon-mail-search': '&#xe7e2;',
		'icon-mail-save': '&#xe7e3;',
		'icon-mail-plus': '&#xe7e4;',
		'icon-mail-open': '&#xe7e5;',
		'icon-mail-open-3': '&#xe7e6;',
		'icon-mail-open-2': '&#xe7e7;',
		'icon-mail-open-1': '&#xe7e8;',
		'icon-mail-minus': '&#xe7e9;',
		'icon-mail-lock': '&#xe7ea;',
		'icon-mail-inbox': '&#xe7eb;',
		'icon-mail-full': '&#xe7ec;',
		'icon-mail-flag1': '&#xe7ed;',
		'icon-mail-flag': '&#xe7ee;',
		'icon-mail-favourite': '&#xe7ef;',
		'icon-mail-favorite': '&#xe7f0;',
		'icon-mail-encryption': '&#xe7f1;',
		'icon-mail-download': '&#xe7f2;',
		'icon-mail-delete': '&#xe7f3;',
		'icon-mail-attachement': '&#xe7f4;',
		'icon-mail-9': '&#xe7f5;',
		'icon-mail-8': '&#xe7f6;',
		'icon-mail-7': '&#xe7f7;',
		'icon-mail-6': '&#xe7f8;',
		'icon-mail-5': '&#xe7f9;',
		'icon-mail-4': '&#xe7fa;',
		'icon-mail-3': '&#xe7fb;',
		'icon-mail-2': '&#xe7fc;',
		'icon-mail-1': '&#xe7fd;',
		'icon-magnifier-8': '&#xe7fe;',
		'icon-magnifier-7': '&#xe7ff;',
		'icon-magnifier-6': '&#xe800;',
		'icon-magnifier-5': '&#xe801;',
		'icon-magnifier-4': '&#xe802;',
		'icon-magnifier-3': '&#xe803;',
		'icon-magnifier-2': '&#xe804;',
		'icon-magnifier-1': '&#xe805;',
		'icon-magic': '&#xe806;',
		'icon-lovedsgn': '&#xe807;',
		'icon-lock-10': '&#xe808;',
		'icon-lock-9': '&#xe809;',
		'icon-lock-8': '&#xe80a;',
		'icon-lock-7': '&#xe80b;',
		'icon-lock-6': '&#xe80c;',
		'icon-lock-5': '&#xe80d;',
		'icon-lock-4': '&#xe80e;',
		'icon-lock-3': '&#xe80f;',
		'icon-lock-2': '&#xe810;',
		'icon-lock-1': '&#xe811;',
		'icon-localseo': '&#xe812;',
		'icon-localseo3': '&#xe813;',
		'icon-localseo2': '&#xe814;',
		'icon-livejournal': '&#xe815;',
		'icon-list': '&#xe816;',
		'icon-linkedin': '&#xe817;',
		'icon-linkedin_alt': '&#xe818;',
		'icon-link-6': '&#xe819;',
		'icon-link-5': '&#xe81a;',
		'icon-link-4': '&#xe81b;',
		'icon-link-3': '&#xe81c;',
		'icon-link-2': '&#xe81d;',
		'icon-link-1': '&#xe81e;',
		'icon-linkbuilding': '&#xe81f;',
		'icon-linkbuilding3': '&#xe820;',
		'icon-linkbuilding2': '&#xe821;',
		'icon-line-chart-8': '&#xe822;',
		'icon-line-chart-7': '&#xe823;',
		'icon-line-chart-6': '&#xe824;',
		'icon-line-chart-5': '&#xe825;',
		'icon-line-chart-4': '&#xe826;',
		'icon-line-chart-3': '&#xe827;',
		'icon-line-chart-2': '&#xe828;',
		'icon-line-chart-1': '&#xe829;',
		'icon-like': '&#xe82a;',
		'icon-light-bulb-16': '&#xe82b;',
		'icon-light-bulb-15': '&#xe82c;',
		'icon-light-bulb-14': '&#xe82d;',
		'icon-light-bulb-13': '&#xe82e;',
		'icon-light-bulb-12': '&#xe82f;',
		'icon-light-bulb-11': '&#xe830;',
		'icon-light-bulb-10': '&#xe831;',
		'icon-light-bulb-9': '&#xe832;',
		'icon-light-bulb-8': '&#xe833;',
		'icon-light-bulb-7': '&#xe834;',
		'icon-light-bulb-6': '&#xe835;',
		'icon-light-bulb-5': '&#xe836;',
		'icon-light-bulb-4': '&#xe837;',
		'icon-light-bulb-3': '&#xe838;',
		'icon-light-bulb-2': '&#xe839;',
		'icon-light-bulb-1': '&#xe83a;',
		'icon-letter-mail-2': '&#xe83b;',
		'icon-letter-mail-1': '&#xe83c;',
		'icon-lastfm': '&#xe83d;',
		'icon-laptop-2': '&#xe83e;',
		'icon-laptop-1': '&#xe83f;',
		'icon-landingpage': '&#xe840;',
		'icon-landingpage3': '&#xe841;',
		'icon-landingpage2': '&#xe842;',
		'icon-krop': '&#xe843;',
		'icon-kiki': '&#xe844;',
		'icon-kik': '&#xe845;',
		'icon-keywordresearch': '&#xe846;',
		'icon-keywordresearch3': '&#xe847;',
		'icon-keywordresearch2': '&#xe848;',
		'icon-key-12': '&#xe849;',
		'icon-key-11': '&#xe84a;',
		'icon-key-10': '&#xe84b;',
		'icon-key-9': '&#xe84c;',
		'icon-key-8': '&#xe84d;',
		'icon-key-7': '&#xe84e;',
		'icon-key-6': '&#xe84f;',
		'icon-key-5': '&#xe850;',
		'icon-key-4': '&#xe851;',
		'icon-key-3': '&#xe852;',
		'icon-key-2': '&#xe853;',
		'icon-key-1': '&#xe854;',
		'icon-justify': '&#xe855;',
		'icon-itunes': '&#xe856;',
		'icon-iphone': '&#xe857;',
		'icon-iphone-portrait': '&#xe858;',
		'icon-iphone-landscape': '&#xe859;',
		'icon-iphone-landscape-portrait': '&#xe85a;',
		'icon-iphone-landscape-portrait-2': '&#xe85b;',
		'icon-ipad-portrait': '&#xe85c;',
		'icon-ipad-landscape': '&#xe85d;',
		'icon-ipad-landscape-portrait': '&#xe85e;',
		'icon-ipad-landscape-portrait-2': '&#xe85f;',
		'icon-instapaper': '&#xe860;',
		'icon-incoming-mail-3': '&#xe861;',
		'icon-incoming-mail-2': '&#xe862;',
		'icon-incoming-mail-1': '&#xe863;',
		'icon-inbox-mail-full-3': '&#xe864;',
		'icon-inbox-mail-full-2': '&#xe865;',
		'icon-inbox-mail-full-1': '&#xe866;',
		'icon-inbox-mail-empty-3': '&#xe867;',
		'icon-inbox-mail-empty-2': '&#xe868;',
		'icon-inbox-mail-empty-1': '&#xe869;',
		'icon-inbox-mail-3': '&#xe86a;',
		'icon-inbox-mail-2': '&#xe86b;',
		'icon-inbox-mail-1': '&#xe86c;',
		'icon-image-10': '&#xe86d;',
		'icon-image-9': '&#xe86e;',
		'icon-image-8': '&#xe86f;',
		'icon-image-7': '&#xe870;',
		'icon-image-6': '&#xe871;',
		'icon-image-5': '&#xe872;',
		'icon-image-4': '&#xe873;',
		'icon-image-3': '&#xe874;',
		'icon-image-2': '&#xe875;',
		'icon-image-1': '&#xe876;',
		'icon-imac': '&#xe877;',
		'icon-identica': '&#xe878;',
		'icon-icq': '&#xe879;',
		'icon-ice-cream': '&#xe87a;',
		'icon-hyves': '&#xe87b;',
		'icon-hype_machine': '&#xe87c;',
		'icon-home-7': '&#xe87d;',
		'icon-home-6': '&#xe87e;',
		'icon-home-5': '&#xe87f;',
		'icon-home-4': '&#xe880;',
		'icon-home-3': '&#xe881;',
		'icon-home-2': '&#xe882;',
		'icon-home-1': '&#xe883;',
		'icon-hi5': '&#xe884;',
		'icon-headphone-8': '&#xe885;',
		'icon-headphone-7': '&#xe886;',
		'icon-headphone-6': '&#xe887;',
		'icon-headphone-5': '&#xe888;',
		'icon-headphone-4': '&#xe889;',
		'icon-headphone-3': '&#xe88a;',
		'icon-headphone-2': '&#xe88b;',
		'icon-headphone-1': '&#xe88c;',
		'icon-half-battery': '&#xe88d;',
		'icon-hacker_news': '&#xe88e;',
		'icon-grumpy': '&#xe88f;',
		'icon-group-3': '&#xe890;',
		'icon-group-2': '&#xe891;',
		'icon-group-1': '&#xe892;',
		'icon-grooveshark': '&#xe893;',
		'icon-gowalla': '&#xe894;',
		'icon-gowalla_alt': '&#xe895;',
		'icon-google': '&#xe896;',
		'icon-google_talk': '&#xe897;',
		'icon-google_buzz': '&#xe898;',
		'icon-googleplaceoptimization': '&#xe899;',
		'icon-googleplaceoptimization3': '&#xe89a;',
		'icon-googleplaceoptimization2': '&#xe89b;',
		'icon-goodreads': '&#xe89c;',
		'icon-glass': '&#xe89d;',
		'icon-glass-2': '&#xe89e;',
		'icon-glass-1': '&#xe89f;',
		'icon-github': '&#xe8a0;',
		'icon-github_alt': '&#xe8a1;',
		'icon-gears': '&#xe8a2;',
		'icon-gears-2': '&#xe8a3;',
		'icon-gear': '&#xe8a4;',
		'icon-gear-21': '&#xe8a5;',
		'icon-gear-8': '&#xe8a6;',
		'icon-gear-7': '&#xe8a7;',
		'icon-gear-6': '&#xe8a8;',
		'icon-gear-5': '&#xe8a9;',
		'icon-gear-4': '&#xe8aa;',
		'icon-gear-3': '&#xe8ab;',
		'icon-gear-2': '&#xe8ac;',
		'icon-gear-1': '&#xe8ad;',
		'icon-gdgt': '&#xe8ae;',
		'icon-full-battery': '&#xe8af;',
		'icon-friendster': '&#xe8b0;',
		'icon-friendfeed': '&#xe8b1;',
		'icon-foursquare': '&#xe8b2;',
		'icon-forrst': '&#xe8b3;',
		'icon-formspring': '&#xe8b4;',
		'icon-football': '&#xe8b5;',
		'icon-folkd': '&#xe8b6;',
		'icon-folder-upload-2': '&#xe8b7;',
		'icon-folder-upload-1': '&#xe8b8;',
		'icon-folder-remove-2': '&#xe8b9;',
		'icon-folder-remove-1': '&#xe8ba;',
		'icon-folder-plus-2': '&#xe8bb;',
		'icon-folder-plus-1': '&#xe8bc;',
		'icon-folder-minus-2': '&#xe8bd;',
		'icon-folder-minus-1': '&#xe8be;',
		'icon-folder-lock': '&#xe8bf;',
		'icon-folder-edit': '&#xe8c0;',
		'icon-folder-download-2': '&#xe8c1;',
		'icon-folder-download-1': '&#xe8c2;',
		'icon-folder-delete': '&#xe8c3;',
		'icon-folder-check': '&#xe8c4;',
		'icon-folder-11': '&#xe8c5;',
		'icon-folder-10': '&#xe8c6;',
		'icon-folder-9': '&#xe8c7;',
		'icon-folder-8': '&#xe8c8;',
		'icon-folder-7': '&#xe8c9;',
		'icon-folder-6': '&#xe8ca;',
		'icon-folder-5': '&#xe8cb;',
		'icon-folder-4': '&#xe8cc;',
		'icon-folder-3': '&#xe8cd;',
		'icon-folder-2': '&#xe8ce;',
		'icon-folder-1': '&#xe8cf;',
		'icon-flickr': '&#xe8d0;',
		'icon-flash': '&#xe8d1;',
		'icon-flash-light': '&#xe8d2;',
		'icon-flag': '&#xe8d3;',
		'icon-film-4': '&#xe8d4;',
		'icon-film-3': '&#xe8d5;',
		'icon-film-2': '&#xe8d6;',
		'icon-film-1': '&#xe8d7;',
		'icon-female-user': '&#xe8d8;',
		'icon-feedburner': '&#xe8d9;',
		'icon-favorite-user': '&#xe8da;',
		'icon-favorite-location': '&#xe8db;',
		'icon-factory-2': '&#xe8dc;',
		'icon-factory-1': '&#xe8dd;',
		'icon-factome': '&#xe8de;',
		'icon-facebook': '&#xe8df;',
		'icon-facebook_places': '&#xe8e0;',
		'icon-facebook_alt': '&#xe8e1;',
		'icon-eyedropper': '&#xe8e2;',
		'icon-evernote': '&#xe8e3;',
		'icon-etsy': '&#xe8e4;',
		'icon-equalizer': '&#xe8e5;',
		'icon-empty-battery': '&#xe8e6;',
		'icon-ember': '&#xe8e7;',
		'icon-embed-close': '&#xe8e8;',
		'icon-embeb': '&#xe8e9;',
		'icon-eight-ball': '&#xe8ea;',
		'icon-ebay': '&#xe8eb;',
		'icon-dzone': '&#xe8ec;',
		'icon-dslr-camera': '&#xe8ed;',
		'icon-drupal': '&#xe8ee;',
		'icon-dropbox': '&#xe8ef;',
		'icon-drill': '&#xe8f0;',
		'icon-dribbble': '&#xe8f1;',
		'icon-diigo': '&#xe8f2;',
		'icon-digital-camera': '&#xe8f3;',
		'icon-digg': '&#xe8f4;',
		'icon-digg_alt': '&#xe8f5;',
		'icon-deviantart': '&#xe8f6;',
		'icon-designmoo': '&#xe8f7;',
		'icon-designfloat': '&#xe8f8;',
		'icon-designbump': '&#xe8f9;',
		'icon-delicious': '&#xe8fa;',
		'icon-delete-location': '&#xe8fb;',
		'icon-dashboard': '&#xe8fc;',
		'icon-dailybooth': '&#xe8fd;',
		'icon-cute': '&#xe8fe;',
		'icon-current-location': '&#xe8ff;',
		'icon-cup': '&#xe900;',
		'icon-cry': '&#xe901;',
		'icon-crop': '&#xe902;',
		'icon-credit-card-remove': '&#xe903;',
		'icon-credit-card-plus': '&#xe904;',
		'icon-credit-card-minus': '&#xe905;',
		'icon-credit-card-lock': '&#xe906;',
		'icon-credit-card-flag': '&#xe907;',
		'icon-credit-card-check': '&#xe908;',
		'icon-credit-card-7': '&#xe909;',
		'icon-credit-card-6': '&#xe90a;',
		'icon-credit-card-5': '&#xe90b;',
		'icon-credit-card-4': '&#xe90c;',
		'icon-credit-card-3': '&#xe90d;',
		'icon-credit-card-2': '&#xe90e;',
		'icon-credit-card-1': '&#xe90f;',
		'icon-creative_commons': '&#xe910;',
		'icon-coroflot': '&#xe911;',
		'icon-computer-7': '&#xe912;',
		'icon-computer-6': '&#xe913;',
		'icon-computer-5': '&#xe914;',
		'icon-computer-4': '&#xe915;',
		'icon-computer-3': '&#xe916;',
		'icon-computer-2': '&#xe917;',
		'icon-computer-1': '&#xe918;',
		'icon-compass-6': '&#xe919;',
		'icon-compass-5': '&#xe91a;',
		'icon-compass-4': '&#xe91b;',
		'icon-compass-3': '&#xe91c;',
		'icon-compass-2': '&#xe91d;',
		'icon-compass-1': '&#xe91e;',
		'icon-comment': '&#xe91f;',
		'icon-coin-money-10': '&#xe920;',
		'icon-coin-money-9': '&#xe921;',
		'icon-coin-money-8': '&#xe922;',
		'icon-coin-money-7': '&#xe923;',
		'icon-coin-money-6': '&#xe924;',
		'icon-coin-money-5': '&#xe925;',
		'icon-coin-money-4': '&#xe926;',
		'icon-coin-money-3': '&#xe927;',
		'icon-coin-money-2': '&#xe928;',
		'icon-coin-money-1': '&#xe929;',
		'icon-codeoptimization': '&#xe92a;',
		'icon-codeoptimization3': '&#xe92b;',
		'icon-codeoptimization2': '&#xe92c;',
		'icon-coconut': '&#xe92d;',
		'icon-cloudapp': '&#xe92e;',
		'icon-cloud': '&#xe92f;',
		'icon-cloud-video-2': '&#xe930;',
		'icon-cloud-video-1': '&#xe931;',
		'icon-cloud-upload': '&#xe932;',
		'icon-cloud-upload-2': '&#xe933;',
		'icon-cloud-upload-1': '&#xe934;',
		'icon-cloud-signal-2': '&#xe935;',
		'icon-cloud-signal-1': '&#xe936;',
		'icon-cloud-remove-2': '&#xe937;',
		'icon-cloud-remove-1': '&#xe938;',
		'icon-cloud-reload-2': '&#xe939;',
		'icon-cloud-reload-1': '&#xe93a;',
		'icon-cloud-refresh-2': '&#xe93b;',
		'icon-cloud-refresh-1': '&#xe93c;',
		'icon-cloud-plus-2': '&#xe93d;',
		'icon-cloud-plus-1': '&#xe93e;',
		'icon-cloud-music-2': '&#xe93f;',
		'icon-cloud-music-1': '&#xe940;',
		'icon-cloud-minus-2': '&#xe941;',
		'icon-cloud-minus-1': '&#xe942;',
		'icon-cloud-menu-2': '&#xe943;',
		'icon-cloud-menu-1': '&#xe944;',
		'icon-cloud-loading-2': '&#xe945;',
		'icon-cloud-loading-1': '&#xe946;',
		'icon-cloud-download': '&#xe947;',
		'icon-cloud-download-2': '&#xe948;',
		'icon-cloud-download-1': '&#xe949;',
		'icon-cloud-connection-2': '&#xe94a;',
		'icon-cloud-connection-1': '&#xe94b;',
		'icon-cloud-check-2': '&#xe94c;',
		'icon-cloud-check-1': '&#xe94d;',
		'icon-cloud-12': '&#xe94e;',
		'icon-cloud-11': '&#xe94f;',
		'icon-cloud-10': '&#xe950;',
		'icon-cloud-9': '&#xe951;',
		'icon-cloud-8': '&#xe952;',
		'icon-cloud-7': '&#xe953;',
		'icon-cloud-6': '&#xe954;',
		'icon-cloud-5': '&#xe955;',
		'icon-cloud-4': '&#xe956;',
		'icon-cloud-3': '&#xe957;',
		'icon-cloud-2': '&#xe958;',
		'icon-cloud-1': '&#xe959;',
		'icon-clock-time-10': '&#xe95a;',
		'icon-clock-time-9': '&#xe95b;',
		'icon-clock-time-8': '&#xe95c;',
		'icon-clock-time-7': '&#xe95d;',
		'icon-clock-time-6': '&#xe95e;',
		'icon-clock-time-5': '&#xe95f;',
		'icon-clock-time-4': '&#xe960;',
		'icon-clock-time-3': '&#xe961;',
		'icon-clock-time-2': '&#xe962;',
		'icon-clock-time-1': '&#xe963;',
		'icon-cinch': '&#xe964;',
		'icon-chruch': '&#xe965;',
		'icon-chat': '&#xe966;',
		'icon-chat-2': '&#xe967;',
		'icon-charging-battery': '&#xe968;',
		'icon-castle': '&#xe969;',
		'icon-cart': '&#xe96a;',
		'icon-cart-plus': '&#xe96b;',
		'icon-cart-minus': '&#xe96c;',
		'icon-car': '&#xe96d;',
		'icon-candle': '&#xe96e;',
		'icon-candle-2': '&#xe96f;',
		'icon-camera1': '&#xe970;',
		'icon-camera': '&#xe971;',
		'icon-camera-10': '&#xe972;',
		'icon-camera-9': '&#xe973;',
		'icon-camera-8': '&#xe974;',
		'icon-camera-7': '&#xe975;',
		'icon-camera-6': '&#xe976;',
		'icon-camera-5': '&#xe977;',
		'icon-camera-4': '&#xe978;',
		'icon-camera-3': '&#xe979;',
		'icon-camera-2': '&#xe97a;',
		'icon-camera-1': '&#xe97b;',
		'icon-calendar': '&#xe97c;',
		'icon-Calendar-Time': '&#xe97d;',
		'icon-Calendar-Remove': '&#xe97e;',
		'icon-Calendar-Delete': '&#xe97f;',
		'icon-Calendar-Check': '&#xe980;',
		'icon-Calendar-Chart': '&#xe981;',
		'icon-Calendar-Add': '&#xe982;',
		'icon-Calendar-4': '&#xe983;',
		'icon-Calendar-3': '&#xe984;',
		'icon-Calendar-2': '&#xe985;',
		'icon-Calendar-1': '&#xe986;',
		'icon-business-woman-3': '&#xe987;',
		'icon-business-woman-2': '&#xe988;',
		'icon-business-woman-1': '&#xe989;',
		'icon-business-man-3': '&#xe98a;',
		'icon-business-man-2': '&#xe98b;',
		'icon-business-man-1': '&#xe98c;',
		'icon-building-5': '&#xe98d;',
		'icon-building-4': '&#xe98e;',
		'icon-building-3': '&#xe98f;',
		'icon-building-2': '&#xe990;',
		'icon-building-1': '&#xe991;',
		'icon-brush': '&#xe992;',
		'icon-brightness-up': '&#xe993;',
		'icon-brightness-down': '&#xe994;',
		'icon-brightkite': '&#xe995;',
		'icon-Briefcase-15': '&#xe996;',
		'icon-Briefcase-14': '&#xe997;',
		'icon-Briefcase-13': '&#xe998;',
		'icon-Briefcase-12': '&#xe999;',
		'icon-Briefcase-11': '&#xe99a;',
		'icon-Briefcase-10': '&#xe99b;',
		'icon-Briefcase-9': '&#xe99c;',
		'icon-Briefcase-8': '&#xe99d;',
		'icon-Briefcase-7': '&#xe99e;',
		'icon-Briefcase-6': '&#xe99f;',
		'icon-Briefcase-5': '&#xe9a0;',
		'icon-Briefcase-4': '&#xe9a1;',
		'icon-Briefcase-3': '&#xe9a2;',
		'icon-Briefcase-2': '&#xe9a3;',
		'icon-Briefcase-1': '&#xe9a4;',
		'icon-bowling-ball': '&#xe9a5;',
		'icon-bookmark': '&#xe9a6;',
		'icon-book-8': '&#xe9a7;',
		'icon-book-7': '&#xe9a8;',
		'icon-book-6': '&#xe9a9;',
		'icon-book-5': '&#xe9aa;',
		'icon-book-4': '&#xe9ab;',
		'icon-book-3': '&#xe9ac;',
		'icon-book-2': '&#xe9ad;',
		'icon-book-1': '&#xe9ae;',
		'icon-bomb': '&#xe9af;',
		'icon-boat': '&#xe9b0;',
		'icon-boat-2': '&#xe9b1;',
		'icon-bnter': '&#xe9b2;',
		'icon-blogger': '&#xe9b3;',
		'icon-blip': '&#xe9b4;',
		'icon-bing': '&#xe9b5;',
		'icon-big-smile': '&#xe9b6;',
		'icon-behance': '&#xe9b7;',
		'icon-beer': '&#xe9b8;',
		'icon-bebo': '&#xe9b9;',
		'icon-beach-umbrella': '&#xe9ba;',
		'icon-beach-umbrella-2': '&#xe9bb;',
		'icon-battery-low': '&#xe9bc;',
		'icon-battery-half': '&#xe9bd;',
		'icon-battery-full': '&#xe9be;',
		'icon-battery-empty': '&#xe9bf;',
		'icon-battery-charging': '&#xe9c0;',
		'icon-basket': '&#xe9c1;',
		'icon-basket-plus': '&#xe9c2;',
		'icon-basket-minus': '&#xe9c3;',
		'icon-basket-10': '&#xe9c4;',
		'icon-basket-9': '&#xe9c5;',
		'icon-basket-8': '&#xe9c6;',
		'icon-basket-7': '&#xe9c7;',
		'icon-basket-6': '&#xe9c8;',
		'icon-basket-5': '&#xe9c9;',
		'icon-basket-4': '&#xe9ca;',
		'icon-basket-3': '&#xe9cb;',
		'icon-basket-2': '&#xe9cc;',
		'icon-basket-1': '&#xe9cd;',
		'icon-basecamp': '&#xe9ce;',
		'icon-baseball': '&#xe9cf;',
		'icon-bar-chart-up': '&#xe9d0;',
		'icon-bar-chart-up-4': '&#xe9d1;',
		'icon-bar-chart-up-3': '&#xe9d2;',
		'icon-bar-chart-up-2': '&#xe9d3;',
		'icon-bar-chart-pyramide3': '&#xe9d4;',
		'icon-bar-chart-pyramide': '&#xe9d5;',
		'icon-bar-chart-pyramide-2': '&#xe9d6;',
		'icon-bar-chart-down': '&#xe9d7;',
		'icon-bar-chart-down-4': '&#xe9d8;',
		'icon-bar-chart-down-3': '&#xe9d9;',
		'icon-bar-chart-down-2': '&#xe9da;',
		'icon-bar-chart-9': '&#xe9db;',
		'icon-bar-chart-8': '&#xe9dc;',
		'icon-bar-chart-7': '&#xe9dd;',
		'icon-bar-chart-6': '&#xe9de;',
		'icon-bar-chart-5': '&#xe9df;',
		'icon-bar-chart-4': '&#xe9e0;',
		'icon-bar-chart-3': '&#xe9e1;',
		'icon-bar-chart-2': '&#xe9e2;',
		'icon-bar-chart-1': '&#xe9e3;',
		'icon-bank': '&#xe9e4;',
		'icon-bank-2': '&#xe9e5;',
		'icon-baidu': '&#xe9e6;',
		'icon-bag-remove': '&#xe9e7;',
		'icon-bag-plus': '&#xe9e8;',
		'icon-bag-minus': '&#xe9e9;',
		'icon-bag-lock': '&#xe9ea;',
		'icon-bag-flag': '&#xe9eb;',
		'icon-bag-check': '&#xe9ec;',
		'icon-bag-10': '&#xe9ed;',
		'icon-bag-9': '&#xe9ee;',
		'icon-bag-8': '&#xe9ef;',
		'icon-bag-7': '&#xe9f0;',
		'icon-bag-6': '&#xe9f1;',
		'icon-bag-5': '&#xe9f2;',
		'icon-bag-4': '&#xe9f3;',
		'icon-bag-3': '&#xe9f4;',
		'icon-bag-2': '&#xe9f5;',
		'icon-bag-1': '&#xe9f6;',
		'icon-aws': '&#xe9f7;',
		'icon-arto': '&#xe9f8;',
		'icon-articlemarketing': '&#xe9f9;',
		'icon-articlemarketing3': '&#xe9fa;',
		'icon-articlemarketing2': '&#xe9fb;',
		'icon-arrow-141': '&#xe9fc;',
		'icon-arrow-40': '&#xe9fd;',
		'icon-arrow-39': '&#xe9fe;',
		'icon-arrow-38': '&#xe9ff;',
		'icon-arrow-37': '&#xea00;',
		'icon-arrow-36': '&#xea01;',
		'icon-arrow-35': '&#xea02;',
		'icon-arrow-34': '&#xea03;',
		'icon-arrow-33': '&#xea04;',
		'icon-arrow-32': '&#xea05;',
		'icon-arrow-31': '&#xea06;',
		'icon-arrow-30': '&#xea07;',
		'icon-arrow-29': '&#xea08;',
		'icon-arrow-28': '&#xea09;',
		'icon-arrow-27': '&#xea0a;',
		'icon-arrow-26': '&#xea0b;',
		'icon-arrow-25': '&#xea0c;',
		'icon-arrow-24': '&#xea0d;',
		'icon-arrow-23': '&#xea0e;',
		'icon-arrow-22': '&#xea0f;',
		'icon-arrow-21': '&#xea10;',
		'icon-arrow-20': '&#xea11;',
		'icon-arrow-19': '&#xea12;',
		'icon-arrow-18': '&#xea13;',
		'icon-arrow-17': '&#xea14;',
		'icon-arrow-16': '&#xea15;',
		'icon-arrow-15': '&#xea16;',
		'icon-arrow-14': '&#xea17;',
		'icon-arrow-13': '&#xea18;',
		'icon-arrow-12': '&#xea19;',
		'icon-arrow-11': '&#xea1a;',
		'icon-arrow-10': '&#xea1b;',
		'icon-arrow-9': '&#xea1c;',
		'icon-arrow-8': '&#xea1d;',
		'icon-arrow-7': '&#xea1e;',
		'icon-arrow-6': '&#xea1f;',
		'icon-arrow-5': '&#xea20;',
		'icon-arrow-4': '&#xea21;',
		'icon-arrow-3': '&#xea22;',
		'icon-arrow-2': '&#xea23;',
		'icon-arrow-1': '&#xea24;',
		'icon-app_store': '&#xea25;',
		'icon-antenna-5': '&#xea26;',
		'icon-antenna-4': '&#xea27;',
		'icon-antenna-3': '&#xea28;',
		'icon-antenna-2': '&#xea29;',
		'icon-antenna-1': '&#xea2a;',
		'icon-analityc': '&#xea2b;',
		'icon-analityc3': '&#xea2c;',
		'icon-analityc2': '&#xea2d;',
		'icon-align-right': '&#xea2e;',
		'icon-align-left': '&#xea2f;',
		'icon-align-center': '&#xea30;',
		'icon-add-user': '&#xea31;',
		'icon-add-tag': '&#xea32;',
		'icon-add-location': '&#xea33;',
		'icon-activesearch': '&#xea34;',
		'icon-activesearch3': '&#xea35;',
		'icon-account': '&#xea36;',
		'icon-activesearch2': '&#xea37;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
