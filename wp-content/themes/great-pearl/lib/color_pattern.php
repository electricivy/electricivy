<?php
global $current_color;
$color_text = "
::selection{
	background-color:#".$current_color.";
}

a,a:link , a:visited{
	color:#".$current_color.";
}

a:hover{
	color:#4d4d4d;
}

#header{
	border-top:10px solid #666666;
	background-color:white;
}

.arrow-down {
	
}


#slider{ 
	background-color:white;
} 

.wope-slider{
	background-color:#f2f2f2;
}

.skin-basic  .wopeslider-ui-button-next:hover{
	background-color:#333333;
}

.skin-basic .wopeslider-ui-button-prev:hover {
	background-color:#333333;
}

.main-color{
	color:#".$current_color.";
}


#body{
	background-color:white;
	color:#666666;
}
 
/* header */



#logo-text,#logo-text a{
	color:#333333;
}

/* socials */
.social-icon{
	background-color:#f2f2f2;
}

.social-icon:hover{
	background-color:#".$current_color.";
}

/* menu */
#main-menu{
	
}

#main-menu ul li a{
	color:#4d4d4d;
	
}

#main-menu ul li a:hover{
	color:white;
	background-color:#666666;
}

#main-menu ul li.current-menu-item a,#main-menu ul li.current-menu-ancestor a{
	color:white;
	background-color:#".$current_color.";
}

#main-menu ul li.current-menu-item a:before,#main-menu ul li.current-menu-ancestor a:before{
	border-top: 6px solid #".$current_color.";
}

/* sub menu */

#main-menu ul ul{
	box-shadow:0px 0px 3px #cccccc;
	background-color:white;
	
}


#main-menu ul li li a,#main-menu ul li li li a, #main-menu ul li.current-menu-item li a , #main-menu ul li.current-menu-item li li a , #main-menu ul li.current-menu-ancestor li a , #main-menu ul li.current-menu-ancestor li li a {
	border-bottom:0px; 
	color:#666666;
	background-color:white;
}

#main-menu ul li li.current-menu-item a , #main-menu ul li li li.current-menu-item a , #main-menu ul li li.current-menu-ancestor a{
	color:white;
	background-color:#666666;
}

#main-menu ul li li a:hover,#main-menu ul li.current-menu-ancestor li a:hover,#main-menu ul li.current-menu-item li li a:hover{
	color:white;
	background-color:#".$current_color.";
}

/* static content */
#static-content{
	background-color:#f2f2f2;
}

.static-content-container{
	color:#4d4d4d;
}

.static-content-container h1{
	color:#333333;
	border-bottom:0px;
}

.static-content-container h2{
	color:#333333;
	border-bottom:0px;
}

.static-content-container h3{
	color:#333333;
	border-bottom:0px;
}

.static-content-container h4{
	color:#333333;
	border-bottom:0px;
}

.static-content-container h5{
	color:#333333;
	border-bottom:0px;
}

.static-content-container h6{
	color:#333333;
	border-bottom:0px;
}

.static-content-container ul a{
	color:#4d4d4d;
}

.static-content-container li a:hover{
	color:#".$current_color.";
}

.flex-caption h1,.flex-caption h2,.flex-caption h3,.flex-caption h4,.flex-caption h5,.flex-caption h6{
	color:white;
}

/* body */

/* index page */

.container-title span,.container-title a{
	color:white;
	background-color:#".$current_color.";
}

.container-title a:hover{
	background-color:#666666;
}



.feature-box:hover{
	background-color:#".$current_color.";
	color:white;
}

.feature-name,.feature-name a{
	color:#333333;
}

.feature-name a:hover{
	color:#".$current_color.";
}

.feature-description{
	color:#999999;
}

.feature-box:hover .feature-name,.feature-box:hover .feature-description{
	color:white;
}

.post-title{
	
}

.post-title a{
	color:#333333;
}

.post-title a:hover{
	color:#".$current_color.";
}

.post-excerpt{
	color:#666666;
}

.post-data{
	border-top:5px solid white;
}

.post-box:hover .post-data{
	border-top:5px solid #".$current_color.";
}

.post-box:hover .post-title a{
	color:#".$current_color.";
}

.thumb-icon{
	background-color:#333333;
}

.thumb-icon:hover{
	background-color:#4d4d4d;
}

.thumb-overlay{
	background-color:#333333;
}

/* typography */
.welcome-box{
	border-left:5px solid #666666;
}

.welcome-text1{
	color:#333333;
}

.welcome-text2{
	color:#666666;
}


hr{
	border-top: 1px solid #e6e6e6;
}


h1{
	color:#333333;
}

h2{
	color:#333333;
}

h3{
	color:#333333;
}

h4{
	color:#333333;
}

h5{
	color:#333333;
}

h6{
	color:#333333;
}

blockquote{
	color:#808080;
	background-color:#fafafa;
	border-left:2px solid #666666;
}

.content li a{
	color:#4d4d4d;
}

.content li a:hover{
	color:#".$current_color.";
}

.highlight{
	background-color:#".$current_color.";
	color:white;
}

.general_msg{
	background-color:white;
	border:1px solid #cccccc;
	color:#808080;
}

.error_msg{
	background-color:#ffdbdb;
	border:1px solid #e58a8a;
	color:#e55c5c;
}

.alert_msg{
	background-color:#fffef2;
	border:1px solid #cccb7a;
	color:#b3b000;
}

.success_msg{
	background-color:#e9ffe5;
	border:1px solid #74cc66;
	color:#16a600;
}

/* inner page */
#page-title-bar{
	background-color:#f7f7f7;
	border-top:1px solid #f2f2f2;
	border-bottom:1px solid #f2f2f2;
}

h2#page-title{
	color:#333333;
}

h3#page-title-sub{
	color:#666666;
}


.paginate a{
	background-color:#f2f2f2;
	color:#333333;
}

.paginate a:hover{
	background-color:#".$current_color.";
	color:white;
}

.paginate .current{
	background-color:#333333;
	color:white;
}

/* 404 page */
.search-field{
	border:1px solid #cccccc;
}

/* about page */
.user_profile_name{
	color:#4d4d4d;
}
 
.user_profile_title{
	color:#333333;
}

.user_profile_data{
	background-color:#f7f7f7;
	color:#4d4d4d;
	border-top:5px solid #".$current_color.";
	border-bottom:1px solid #cccccc;
}
/* services page */


/* blog page */

.post-entry-title a{
	color:#333333;
}

.post-entry-title a:hover{
	color:#".$current_color.";
}

.post-entry-content{
	color:#666666;
}


.post-meta-entry{
	color:#999999;
	border-left:3px solid #999999;
}

.post-meta-entry a{
	color:#333333;
}

.post-meta-entry a:hover{
	color:#".$current_color.";
}


.post-entry-button a{
	color:#".$current_color.";
}

.post-entry-button a:hover{
	color:#333333;
}

/* post list */
.post-list{
	border-bottom:1px solid #f2f2f2;
}

.post-list-title a{
	color:#4d4d4d;
}

.post-list-title a:hover{
	color:#".$current_color.";
}

.post-list-date{
	color:#999999;
}

.post-list-date a{
	color:#999999;
}

.post-list-date a:hover{
	color:#".$current_color.";
}
	
/* project page */
.project-entry-field{
	color:#666666;
	
}

.meta-categories,.meta-categories a{
	color:#4d4d4d;
}

.meta-categories a:hover{
	color:#".$current_color.";
}

.meta-date{
	color:#4d4d4d;
}



.project-cell-categories a{
	color:white;
}


.project-cell-info{
	background-color:#".$current_color.";
}


/* comment section */
.comment-avatar{
	background-color:#f2f2f2;
}

.comment-avatar:hover{
	background-color:#cccccc;
}

#body .comment-info .fn{
	color:#4d4d4d;
}

#body .comment-info .fn a{
	color:#4d4d4d;
}

#body .comment-info .fn a:hover{
	color:#".$current_color.";
}

#body .comment-info  .comment-date a{
	color:#999999;
}

#body .comment-info  .comment-date a:hover{
	color:#".$current_color.";
}

.comment-content{
	color:#666666;
	border:1px solid #e6e6e6;
}

.bypostauthor .comment-content{
	color:#4d4d4d;
	border:1px solid #cccccc;
	background-color:#f2f2f2;
}

#body .comment-reply a{
	background-color:#666666;
	color:white;
}

#body .comment-reply a:hover{
	background-color:#333333;
	color:white;
}


.comment-notes{
	color:#666666;
}
	
.comment-form-author label , .comment-form-email label , .comment-form-url label , .comment-form-subject label{
	color:#999999;
}

.comment-form-author input , .comment-form-email input , .comment-form-url input , .comment-form-subject input{
	border:2px solid #f2f2f2; 
	background-color:#fafafa;
	color:#666666;
}

.comment-form-comment textarea{
	border:2px solid #f2f2f2; 
	background-color:#fafafa;
	color:#666666;
}



/* accordion */

.accor-title{
	color:#666666;
	background-color:#f2f2f2;
	border-left:3px solid #cccccc;
}



.ui-state-active{
	color:white;
	background-color:#".$current_color.";
	border-left:3px solid #333333;
}

.ui-state-focus{
	outline:0px;
}

/* tabs */
.tab-top{
	
}

.tab-title{
	color:#666666;
	background-color:#f2f2f2;
	border-bottom:3px solid #cccccc;
}

.tab-current{
	color:white;
	background-color:#".$current_color.";
	border-bottom:3px solid #333333;
}

/* table */
#body table{
	border:1px solid #1a1a1a;
}

#body thead td, #body tfoot td{
	color:white;
	background-color:#333333;
	border:1px solid #1a1a1a;
}

#body tbody td{
	color:#333333;
	border:1px dotted #cccccc;
}

#body tbody tr:hover{
	background-color:#f2f2f2;
	color:#333333;
	border:1px solid #cccccc;
}

/* testimonials */

.testimonials-title span,.testimonials-title a{
	color:white;
	background-color:#".$current_color.";
}

.testimonials-title a:hover{
	background-color:#666666;
}


.testimonials-button-next , .testimonials-button-prev{
	background-color:#4d4d4d;
}

.testimonials-button-next:hover , .testimonials-button-prev:hover{
	background-color:#".$current_color.";
}

.testimonials-author{
	color:#333333;
	
}

.testimonials-content{
	color:#666666;
	background-color:#f7f7f7;
	border:1px solid #e6e6e6;
}

.testimonials-each{
	
}

/* highlight box*/
.highlight-box{

	border:3px solid #".$current_color.";
}

/* button */

.submit-button,#comment-form input[type=submit]{
	background-color:#4d4d4d;
	color:white;
	border:0px;
	box-shadow:0 0 0 3px #e6e6e6;
}

.submit-button:hover,#comment-form input[type=submit]:hover{
	background-color:#".$current_color.";
	color:white;
	border:0px;
}

.search-button{
	background-color:#4d4d4d;
	color:white;
	border:0px;
	box-shadow:0 0 0 3px #e6e6e6;
}

.search-button:hover{
	background-color:#".$current_color.";
	color:white;
	border:0px;
}

a.small-button,.small-button{
	background-color:#4d4d4d;
	color:white;
	box-shadow:0 0 0 3px #e6e6e6;
}

a.small-button:hover,.small-button:hover{
	background-color:#".$current_color.";
	color:white;
}

a.curver-button,.curver-button{
	background-color:#4d4d4d;
	color:white;
	box-shadow:0 0 0 3px #e6e6e6;
}

a.curver-button:hover,.curver-button:hover{
	background-color:#".$current_color.";
	color:white;
}

a.big-button ,.big-button{
	background-color:#4d4d4d;
	color:white;
	box-shadow:0 0 0 3px #e6e6e6;
}

a.big-button:hover,.big-button:hover{
	background-color:#".$current_color.";
	color:white;
} 

a.welcome-button ,.welcome-button{ 
	background-color:#4d4d4d;
	color:white;
	box-shadow:0 0 0 3px #e6e6e6;
}

a.welcome-button:hover,.welcome-button:hover{
	background-color:#".$current_color.";
	color:white;
}

/* footer */

#footer{
	background-color:#f2f2f2;
	color:#666666;
	border-top:1px solid #e6e6e6;
}


#footer .footer-widget{ 
	color:#666666;
}

#footer .footer-widget ul{
	
}

#footer .footer-widget ul li{

}

#footer .footer-widget ul li a{
	color:#4d4d4d;
}

#footer  .footer-widget ul li a:hover{
	color:#".$current_color.";
}


#footer-bottom{
	color:white;
	background-color:#4d4d4d;
	border-top:10px solid #".$current_color.";
}

 
#footer-bottom a{
	color:white;
}

#footer-bottom a:hover{
	color:#".$current_color.";
}

#footer-copyright{
	color:white;
}

#footer-copyright a{
	color:#f2f2f2;
}

#footer-copyright a:hover{
	color:#".$current_color.";
}


/* widget */

.sidebar-widget-title span{
	color:white;
	background-color:#".$current_color.";
}

#footer .footer-widget .sidebar-widget-title span{
	color:white;
	background-color:#666666;
}

.sidebar-widget{
	color:#808080;
}

.sidebar-widget a{
	color:#666666;
}

.sidebar-widget a:hover{
	color:#".$current_color.";
}


/* search widget */

.search-input{
	border:2px solid #f2f2f2;
	color:#666666;
}

/* tagcloud */

.tagcloud a{
	background-color:#4d4d4d;
	color:white;
}

.tagcloud a:hover{
	background-color:#".$current_color.";
	color:white;
}


/* widget post */
.widget-post-thumb{
	background-color:#f2f2f2;
}

.widget-post-thumb:hover{
	background-color:#4d4d4d;
}

a.widget-post-title{
	color:#4d4d4d;
}

a.widget-post-title:hover{
	color:#".$current_color.";
}

a.widget-post-date{
	color:#b3b3b3;
}

a.widget-post-date:hover{
	color:#".$current_color.";
}

/* project widget */
.project-cell-title a{
	color:white;
}

.project-cell-title a:hover{
	color:white;
}


/* comment widget */
.widget-comment-avatar{
	background-color:#f2f2f2;
}

.widget-comment-avatar:hover{
	background-color:#4d4d4d;
}

a.widget-comment-content{
	color:#b3b3b3;
}

a.widget-comment-author{
	color:#4d4d4d;
}

a.widget-comment-content:hover{
	color:#".$current_color.";
}

a.widget-comment-author:hover{
	color:#".$current_color.";
}

/* twitter widget */
#twitter_update_list li a{
	color:#333333;
	font-weight:bold;
}

#twitter_update_list li  a:hover{
	color:#".$current_color.";
}


#footer .footer-widget #twitter_update_list li span a{
	font-weight:normal;
	text-decoration:underline;
	color:#999999;
}

#footer .footer-widget #twitter_update_list li span a:hover{
	color:#".$current_color.";
}

#twitter_div #twitter-link{
	color:#333333;
	font-weight:bold;
}

#twitter_div #twitter-link:hover{
	color:#".$current_color.";
}

/* flex */

.flex-caption-content{
	border-bottom:5px solid #".$current_color.";
}

.flex-control-paging li a:hover { background: #".$current_color.";}

";

$parent_dir = dirname(dirname(__FILE__));
$color_file = $parent_dir.DS.'color-scheme'.DS."color.css";
file_put_contents($color_file,$color_text);