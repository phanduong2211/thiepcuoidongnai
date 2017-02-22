-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql111.freevnn.com
-- Generation Time: Feb 22, 2017 at 11:38 AM
-- Server version: 5.6.34-79.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `freev_19382391_thiepcuoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_username_unique` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`, `phone`, `level`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'phan văn đương', 'admin', '73e405f743f6652554115b1d2809ab50', 'admin@gmail.com', '0123456789', 1, 1, NULL, '0000-00-00 00:00:00', '2016-02-17 07:34:53'),
(2, 'user', 'user', 'e10adc3949ba59abbe56e057f20f883e', 'user@gmail.com', '0123456789', 1, 1, NULL, '2017-01-04 06:35:54', '2017-01-04 06:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `name`, `image`, `url`, `type`, `created_at`, `updated_at`) VALUES
(2, 'quảng cáo tháng 11', 'ads/thevest.jpg', '', '0', '2016-11-26 04:44:58', '2017-01-04 06:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(11, 'Thiệp cưới đẹp 2016', '', '2016-11-26 10:56:51', '2016-11-26 10:56:51'),
(12, 'Thiệp cưới ấn tượng', '', '2016-11-26 10:57:08', '2016-11-26 10:57:08'),
(13, 'Thiệp cưới hiện đại', '', '2016-11-26 10:57:16', '2016-11-26 10:57:16'),
(14, 'Thiệp cưới mỹ thuật', '', '2016-11-26 10:57:34', '2016-11-26 10:57:34'),
(15, 'Thiệp cưới cao cấp', '', '2016-11-26 10:57:42', '2016-11-26 10:57:42'),
(16, 'Thiếp cưới in ảnh', '', '2016-11-26 10:57:53', '2016-11-26 10:57:53'),
(17, 'Thiếp cưới Hot', '', '2016-11-26 10:58:00', '2016-11-26 10:58:00'),
(18, 'Thiệp cưới truyền thống', '', '2016-11-26 10:58:10', '2016-11-26 10:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `categorynews`
--

CREATE TABLE IF NOT EXISTS `categorynews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detailorder`
--

CREATE TABLE IF NOT EXISTS `detailorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `orderID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detailproduct`
--

CREATE TABLE IF NOT EXISTS `detailproduct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `images` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `silebar_images` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `infomation` text COLLATE utf8_unicode_ci,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `data_sheet` text COLLATE utf8_unicode_ci,
  `productID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `detailproduct`
--

INSERT INTO `detailproduct` (`id`, `images`, `silebar_images`, `infomation`, `size`, `color`, `comment`, `data_sheet`, `productID`, `created_at`, `updated_at`) VALUES
(100, 'product/20140904043021thiepcuoideph42.jpg', 'product/20140904043021thiepcuoideph42.jpg', '<p>+ Cấu tạo: Chất liệu giấy ngoại nhập cao cấp, định lượng dày<br>Thiệp cưới 1 bộ bao gồm<br>( Bao thiệp + Thiệp báo tin + Thiệp mời )<br>+ Thiết kế: Theo phong cách hiện đại,độc đáo, tinh tế, sang trọng.<br>+GIÁ THỊ TRƯỜNG 4.500đGIẢM CÒN 2.300đ</p><p>(HƠN 300 MẪU MỚI-ĐẸP)</p><p>+ Nếu in hình cô dâu- chú rễ ( cộng thêm 500đ/cái)</p><p>+ Hỗ trợ XEM MẪU THỰC TẾ TRƯỚC KHI ĐẶT IN. Dù Qúy Khách ở đâu trên toàn quốc, chúng tôi sẽ gửi mẫu thực tế cho Qúy Khách xem trước khi in.</p><pbackground-color:="" font-size:="" helvetica="" line-height:="" style="margin-bottom: 0px; padding: 0px; outline: none; color: rgb(51, 51, 51); font-family: Arial, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 14px; line-height: 20px; background-color: rgb(255, 255, 255);">+ Thời gian hoàn thành: từ 4-5 ngày ( sau ngày duyệt mẫu và ngày nghỉ )<p></p><p>+ GIAO HÀNG TẬN NƠI TRÊN TOÀN QUỐC</p></pbackground-color:="">', 'xl', 'red', '', '<br>', 102, '2016-11-26 11:00:40', '2016-11-26 11:01:25'),
(101, 'product/thiepcuoic1014689790959fpjcp.jpg', 'product/thiepcuoic1014689790959fpjcp.jpg', '<h3><font color="#ff0000"><b>+ Cấu tạo:Chất liệu giấy ngoại nhập cao cấp, định lượng dày<br></b></font><font color="#ff0000"><b>Thiệp cưới 1 bộ bao gồm<br></b></font><font color="#ff0000"><b>( Bao thiệp + Thiệp báo tin + Thiệp mời )<br></b></font><font color="#ff0000"><b>+ Thiết kế:Theo phong cách hiện đại,độc đáo, tinh tế, sang trọng.<br></b></font><font color="#ff0000"><b>+GIÁ THỊ TRƯỜNG 4.500đGIẢM CÒN 2.300đ<br></b></font><font color="#ff0000"><b>(HƠN 300 MẪU MỚI-ĐẸP)<br></b></font><font color="#ff0000"><b>+ Nếu in hình cô dâu- chú rễ ( cộng thêm 500đ/cái)<br></b></font><font color="#ff0000"><b>+ Hỗ trợ XEM MẪU THỰC TẾ TRƯỚC KHI ĐẶT IN. Dù Qúy Khách ở đâu trên toàn quốc, chúng tôi sẽ gửi mẫu thực tế cho Qúy Khách xem trước khi i</b>n.</font></h3>', 'xl', 'red', '', '<br>', 103, '2016-11-26 11:03:59', '2016-11-26 11:04:38'),
(102, 'product/20140904044630thiepcuoideph47.jpg', 'product/20140904044630thiepcuoideph47.jpg', '<h4><font color="#ff0000"><b>+ Cấu tạo:Chất liệu giấy ngoại nhập cao cấp, định lượng dày<br></b><b>Thiệp cưới 1 bộ bao gồm<br></b><b>( Bao thiệp + Thiệp báo tin + Thiệp mời )<br></b><b>+ Thiết kế:Theo phong cách hiện đại,độc đáo, tinh tế, sang trọng.<br></b><b>+GIÁ THỊ TRƯỜNG 4.500đGIẢM CÒN 2.300đ<br></b><b>(HƠN 300 MẪU MỚI-ĐẸP)<br></b><b>+ Nếu in hình cô dâu- chú rễ ( cộng thêm 500đ/cái)<br></b><b>+ Hỗ trợ XEM MẪU THỰC TẾ TRƯỚC KHI ĐẶT IN. Dù Qúy Khách ở đâu trên toàn quốc, chúng tôi sẽ gửi mẫu thực tế cho Qúy Khách xem trước khi in.</b></font></h4>', 'xl', 'red', '', '<br>', 104, '2016-11-26 11:07:07', '2016-11-26 11:08:11'),
(103, 'product/thiepcuoimp4914690082119yfrnx.jpg', 'product/thiepcuoimp4914690082119yfrnx.jpg', '<h4><font color="#ff0000"><b>+ Cấu tạo: Chất liệu giấy ngoại nhập cao cấp, định lượng dày<br></b><b>Thiệp cưới 1 bộ bao gồm<br></b><b>( Bao thiệp + Thiệp báo tin + Thiệp mời )<br></b><b>+ Thiết kế: Theo phong cách hiện đại, độc đáo, tinh tế, sang trọng.<br></b><b>+GIÁ THỊ TRƯỜNG 7.500đGIẢM CÒN 3.900đ<br></b><b>+(HƠN 300 MẪU MỚI-ĐẸP)<br></b><b>+ Nếu in hình cô dâu- chú rễ ( cộng thêm 500đ/cái)</b><b><br></b><b>+ Hổ trợ XEM MẪU THỰC TẾ TRƯỚC KHI ĐẶT IN. Dù Qúy Khách ở đâu trên toàn quốc, chúng tôi sẽ gửi mẫu thực tế cho Qúy Khách xem trước khi in.</b></font></h4>', 'xl', 'red', '', '<br>', 105, '2016-11-26 11:09:46', '2016-11-26 11:10:12'),
(104, 'product/thiepcuoic2014689812299my84d.jpg', 'product/thiepcuoic2014689812299my84d.jpg', '<h4><font color="#ff0000"><b>+ Cấu tạo:Chất liệu giấy ngoại nhập cao cấp, định lượng dày<br></b><b>Thiệp cưới 1 bộ bao gồm<br></b><b>( Bao thiệp + Thiệp báo tin + Thiệp mời )<br></b><b>+ Thiết kế:Theo phong cách hiện đại,độc đáo, tinh tế, sang trọng.<br></b><b>+GIÁ THỊ TRƯỜNG 4.000đGIẢM CÒN 2.300đ<br></b><b>(HƠN 300 MẪU MỚI-ĐẸP)<br></b><b>+ Nếu in hình cô dâu- chú rễ ( cộng thêm 500đ/cái)<br></b><b>+ Hỗ trợ XEM MẪU THỰC TẾ TRƯỚC KHI ĐẶT IN. Dù Qúy Khách ở đâu trên toàn quốc, chúng tôi sẽ gửi mẫu thực tế cho Qúy Khách xem trước khi in.</b></font></h4>', 'xl', 'red', '', '<br>', 106, '2016-11-26 11:20:04', '2016-11-26 11:20:35'),
(105, 'product/thiepcuoimp6111469160826geazqr.jpg', 'product/thiepcuoimp6111469160826geazqr.jpg', '<h4><font color="#ff0000"><b>+ Cấu tạo: Chất liệu giấy ngoại nhập cao cấp, định lượng dày<br></b><b>Thiệp cưới 1 bộ bao gồm<br></b><b>( Bao thiệp + Thiệp báo tin + Thiệp mời )<br></b><b>+ Thiết kế: Theo phong cách hiện đại,độc đáo, tinh tế, sang trọng.<br></b><b>+GIÁ THỊ TRƯỜNG 7.500đGIẢM CÒN 3.900đ<br></b><b>+(HƠN 300 MẪU MỚI-ĐẸP)<br></b><b>+ Nếu in hình cô dâu- chú rễ ( cộng thêm 500đ/cái)</b><b><br></b><b>+ Hỗ trợ XEM MẪU THỰC TẾ TRƯỚC KHI ĐẶT IN. Dù Qúy Khách ở đâu trên toàn quốc, chúng tôi sẽ gửi mẫu thực tế cho Qúy Khách xem trước khi in.</b></font></h4>', 'xl', 'red', '', '<br>', 107, '2016-11-26 11:21:44', '2016-11-26 11:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `finishorder`
--

CREATE TABLE IF NOT EXISTS `finishorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idorder` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contents` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `name`, `contents`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'http://facebook.com/thiepcuoidongnai', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(2, 'google', 'http://google.com/pages/phukienthoitrang', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(3, 'address', '66 TỔ 2, KHU 1, ẤP 1, AN HÒA, BIÊN HÒA, ĐỒNG NAI', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(4, 'phone', '+84 901 554 598', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(5, 'email', 'thiepcuoibaongoc.bienhoa@gmail.com', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(6, 'skype', 'skype:phanduong221193?chat', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(7, 'twitter', 'http://twiter', '0000-00-00 00:00:00', '2017-01-03 02:58:50'),
(8, 'maps', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d62692.50714003679!2d106.692172!3d10.866166!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x482a821393172468!2zbG92YWR3ZWIgLSB0aGnhur90IGvhur8gd2Vic2l0ZQ!5e0!3m2!1svi!2sus!4v1480241123467" width="100%" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>', '0000-00-00 00:00:00', '2017-01-03 02:54:07'),
(9, 'logo', 'logo.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'brand', 'upload/1.png,upload/2.png,upload/3.png,upload/4.png,upload/4.png', '0000-00-00 00:00:00', '2016-01-21 15:16:04'),
(11, 'favicon', 'public/img/favicon.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'keyword', 'thiep cuoi gia re, thiep cuoi dang cap, thiep cuoi dep, thiep cuoi thoi dai', '0000-00-00 00:00:00', '2017-01-03 02:54:07'),
(13, 'description', 'chuyên cung cấp thiệp cưới thời trang giá rẻ, hợp thời trang, phong cách mà không kém phần sang trọng', '0000-00-00 00:00:00', '2017-01-03 02:54:07'),
(14, 'title', 'THIỆP CƯỚI BẢO NGỌC', '0000-00-00 00:00:00', '2017-01-03 02:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `root`, `name`, `url`, `created_at`, `updated_at`) VALUES
(18, 0, 'Thanh Toán', 'pages/thanh-toan', '2016-11-26 04:33:47', '2016-11-26 11:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_24_065352_crate_product_table', 1),
('2015_12_25_043339_create_munu_table', 1),
('2015_12_25_093224_create_slideshow_table', 1),
('2015_12_26_050011_create_news_table', 1),
('2015_12_26_143125_create_tab_category_table', 1),
('2015_12_27_034920_create_detail_product_table', 1),
('2015_12_27_102723_create_category_table', 1),
('2015_12_28_071808_create_ads_table', 1),
('2016_01_05_034315_crate_wishlist_table', 1),
('2016_01_09_143932_create_admin_table', 1),
('2016_01_11_082055_create_info_table', 1),
('2016_01_12_085534_create_categoryNews_table', 1),
('2016_01_13_120234_add_column_to_product_table', 1),
('2016_01_13_132257_add_originalprice_to_product_table', 1),
('2016_01_14_105339_create_tag_table', 1),
('2016_01_14_105840_add_column_tag_in_product', 1),
('2016_01_14_212529_update_tagid_product_table', 1),
('2016_01_14_220647_update_type_product_table', 1),
('2016_01_17_205550_create_order_table', 2),
('2016_01_17_205603_create_detailorder_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categoryNewsID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `display` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `name`, `image`, `description`, `content`, `view`, `user`, `categoryNewsID`, `created_at`, `updated_at`, `display`) VALUES
(4, 'VÒNG CỔ CHOKER – PHỤ KIỆN THỜI TRANG LÀM CÁC NAM THẦN CŨNG MÊ MỆT', 'news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet3.jpg', 'Với sự hưởng ứng nhiệt tình của các mỹ nhân, mà các nam thần cũng không tránh khỏi vòng xoáy của cơn sốt vòng choker – phụ kiện thời trang làm mưa làm gió trong thời gian gần đây.', '<p style="text-align: justify;"><strong><font size="3">Với\r\nsự hưởng ứng nhiệt tình của các mỹ nhân, mà các nam thần cũng không tránh khỏi\r\nvòng xoáy của cơn sốt vòng choker – phụ kiện thời trang làm mưa làm gió trong\r\nthời gian gần đây.</font></strong></p><p style="text-align: justify;"><font size="3">Vòng cổ choker không chỉ làm\r\ntan chảy trái tim của nhiều tín đồ thời trang nữ, mà nó còn lấn sân sang các mỹ\r\nnam nhà ta. Các nam thần không chỉ hưởng ứng nhiệt tình mà còn tạo hiệu ứng thời\r\ntrang vô cùng lịch lãm, sang trọng. Hãy cùng <b>phukienthoitranggiare.xyz</b> học lõm vài\r\nchiêu mix <b>phụ kiện thời trang</b> với vòng cổ choker của các nam thần Kbiz.</font></p><p style="text-align: justify;"><font size="3" color="#ff0099"><b>1. Áo\r\nvest + áo thun + vòng choker</b></font></p><p style="text-align: justify;"><font size="3">Bộ ba áo vest, áo thun và\r\nvòng cổ choker được hầu hết các mỹ nam thần lăng xê tích cực. Với sự khóe léo\r\ntrong việc lựa chọn màu sắc trang phục, kiểu tóc, thiết kế của vòng choker mà\r\ncác mỹ nam nhà ta trông vô cùng lịch lãm, sang trọng và đáng yêu. </font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet3.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Với tông hồng của chiếc áo\r\nkhoác vest, thành viên của nhóm Big Bang, G-Dragon chứng tỏ mình là một\r\ntrendsetter thực thụ khi khóe léo mix cùng dây choker sát cổ dạng dây mảnh và mặt\r\ntrái tim đáng yêu. Anh chàng thật đáng yêu và nổi bật giữa đám đông với mái tóc\r\nvàng cam sang chảnh.</font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet4.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Anh chàng Bambam của nhóm\r\nGOT7 cũng không kém cạnh khi diện vòng choker dạng bản nhỏ kiểu cách với dạng\r\nkhoen và mặt dây nhỏ làm <b>phụ kiện thời trang</b> khi mix cùng áo khoác đỏ\r\ntur-sur-tone với màu tóc hun đỏ đáng yêu. Để điểm xuyến thêm guu thời trang này\r\nanh chàng còn trang điểm đậm cho mắt thêm phong cách, cá tính.</font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet5.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Nhờ <b>phụ kiện thời trang</b> vòng\r\nchoker bản nhỏ trơn mà anh chàng Hyungwon dễ dàng hóa thân thành chàng dracula\r\nquyến rũ trong set đồ áo sơ mi đen, vest đỏ.</font></p><p><span style="text-align: justify; text-indent: -0.25in; line-height: 1.42857;"><font size="3" color="#ff0099"><b>2. Áo\r\nsơ mi + vòng choker</b></font></span></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Bộ đôi áo sơ mi và vòng\r\nchoker làm <b>phụ kiện thời trang</b> kèm theo là item yêu thích của chàng ca sĩ Nam\r\nTae Hyun, anh chàng được nhận xét là vô cùng đáng yêu với sự kết hợp này. Xuất\r\nhiện trên sân khấu với chiếc áo sơ mi cách điệu với cổ khoét sâu mix cùng miếng\r\nvải đen dạng trơn được buộc tạo thành chiếc choker cá tính.</font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet6.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Không ngoại lệ anh chàng\r\nL.Joe (TEEN TOP) lại khá thích thú với những chiếc vòng sát cổ bản nhỏ đáng yêu\r\nkhi diện cùng áo sơ mi đen để mở 2,3 cúc áo trên cùng.</font></p><p style="text-align: start; text-indent: 0px;"><font size="3" color="#ff0099"><b><span style="text-align: justify; text-indent: -0.25in;">3</span><span style="text-align: justify; text-indent: -0.25in; line-height: 1.42857;">. Áo\r\nthun + vòng choker</span></b></font></p><p style="text-align: start; text-indent: 0px;"><span style="text-align: justify; text-indent: -0.25in; line-height: 1.42857;"><font size="3">Khi dạo phố các nam thần của\r\nKbiz cũng lăng xê nhiệt tình cho item này, <b>phụ kiện thời trang</b> vòng choker khi\r\nkết hợp cùng áo thun lại làm nổi bật vẻ điển trai trong set đồ đơn giản.</font></span></p><p style="text-align: center; text-indent: 0px;"><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet7.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Mix áo len cổ tròn đơn giản\r\nvới vòng choker layering với những dây chuyền dáng dài khác nhau trong anh\r\nchàng Wonho khá bắt mắt với nụ cười tỏa nắng. Mái tóc nhuộm cũng làm anh chàng\r\nkhá là thu hút có thể làm liêu xiêu trái tim của các bạn nữ nhà ta đấy.</font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/vong-co-choker-phu-kien-thoi-trang-lam-cac-nam-than-me-met/phukienthoitranggiarevongcochokerphukienthoitranglamcacnamthanmemet1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Áo thun trắng mix cùng\r\nchoker dạng bản mảnh là item mà anh chàng L.Joe ưa thích, với sự kết hợp đồng\r\nđiệu anh chàng trông thật lạnh lùng nhưng vô cùng đáng yêu và cá tính.</font></p><p>\r\n\r\n</p><p style="text-align: justify;"><font size="3">Đâu phải những <b>phụ kiện thời\r\ntrang</b> vòng cổ choker chỉ dành riêng cho nữ giới đâu chứ, nó còn mang một màu sắc\r\nkhác khi phái mạnh chúng ta biến hóa guu thời trang này.</font></p>', 334, '1', '1', '2016-02-20 15:11:49', '2016-02-24 22:09:40', 1),
(5, 'NHỮNG CÁCH MIX PHỤ KIỆN THỜI TRANG VÒNG CHOKER ĐA SẮC MÀU', 'news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac1.jpg', 'Vòng cổ choker được xem là phụ kiện thời trang thần thánh bởi sự kết hợp đa dạng với tất cả các loại trang phục mà không một phụ nữ nào có thể cưỡng lại sức hút này.', '<p style="text-align: justify;"><strong><font size="3">Vòng\r\ncổ choker được xem là phụ kiện thời trang thần thánh bởi sự kết hợp đa dạng với\r\ntất cả các loại trang phục mà không một phụ nữ nào có thể cưỡng lại sức hút\r\nnày.</font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Vòng cổ choker của những thập\r\nniên 90 đã trở mình một cách mạnh mẽ với thiết kế vô cùng sáng tạo và cá tính.\r\nVới sức hút mạnh mẽ đó mà các teen nhà ta cũng không thoát khỏi vòng xoáy thời\r\ntrang thời thượng này. Như một người bạn đồng hành, hãy cùng <strong>phukienthoitranggiare.xyz</strong> khám phá sự kết\r\nhợp đa màu sắc của vòng choker nhé!</font></p>\r\n\r\n<p><font size="3" color="#ff0099"><b>1. \r\nMix vòng choker với áo ống</b></font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Áo ống được xem là chiếc áo\r\nquyến rũ nhất khi khóe léo khoe đôi vai trần gợi cảm và đôi gò bồng đảo căng\r\ntròn. Khi diện áo ống thì phần trước ngực của bạn trông thật trống trải, bạn có\r\nthể lựa chọn một chiếc vòng cổ choker làm <strong>phụ\r\nkiện thời trang</strong> để bớt trống trải, đồng thời khóe léo tôn vinh chiếc cổ\r\nthon dài, trắng ngần của bạn.</font></p><pclass="msolistparagraph" style="text-align:justify;text-indent:-.25in;\r\nmso-list:l0 level1 lfo1"><font size="3" color="#ff0099"><b>2. \r\nMix vòng choker với áo croptop</b></font></pclass="msolistparagraph"><div><div style="text-align: center; text-indent: -24px;"><br></div></div><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac1.jpg"></div><div class="postimg" style="text-align: justify;"><font size="3"><span style="line-height: 1.42857;">Croptop là một trong những\r\nitem được giới trẻ yêu thích, với sự kết hợp giữa bộ đôi áo croptop và vòng\r\nchoker sẽ vô cùng thú vị. Choker và croptop sẽ làm cho bộ đôi trở nên đáng yêu,\r\nnhí nhảnh và dễ thương như cô nàng Hàn Quốc đấy!</span><br></font></div><div class="postimg" style="text-align: left;">\r\n\r\n<p><font size="3" color="#ff0099"><b>3. \r\nMix vòng choker với áo sơ mi</b></font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac6.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Vòng choker và áo sơ mi được\r\nmệnh danh là cặp đôi sexy khi mix cùng nhau. Với chiếc áo sơ mi được tháo 2, 3\r\ncúc áo trên phối cùng chiếc vòng choker nhỏ xinh, bạn sẽ vô cùng xinh đẹp như\r\ncô nàng Go Joon Hee bước ra từ bộ phim “She was Pretty”.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac5.jpg" style="line-height: 1.42857;"><br></p><p><font size="3" color="#ff0099"><b>4. \r\nMix vòng choker với đầm dáng suông</b></font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac4.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Nếu bạn là một tín đồ của\r\nvòng choker thì bạn vẫn có thể an tâm khi phối cùng với đầm dáng suông. Nếu chiếc\r\nđầm có thiết kế dễ thương, đáng yêu thì nên lựa chọn vòng choker dạng ren, nơ,\r\nmang vẻ đẹp dịu dàng, nữ tính. Khi phối vòng choker với đầm dáng suông cá tính\r\nthì kèm theo đó thì <strong>phụ kiện thời trang</strong>\r\nchoker cũng phải đồng điệu, cá tính.</font></p><p><font size="3" color="#ff0099"><b>5. \r\nMix vòng choker với áo thun </b></font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac2.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3"><strong>Phụ\r\nkiện thời trang</strong> vòng choker cá tính là cặp bài trùng với áo\r\nthun đấy nha, với sự kết hợp của 2 item này bạn sẽ trông thật cá tính, năng động\r\nvà vô cùng đáng yêu. Bạn có thể lựa chọn những choker dạng trơn để phù hợp với\r\ntất cả những chiếc áo thun trong tủ quần áo của bạn.</font></p><p><b><font color="#ff0099" size="3">6. \r\nMix vòng choker với áo cổ lọ</font></b></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac3.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Thời tiết se lạnh thì một\r\nchiếc áo cổ lọ sẽ giúp bạn giữ ấm cơ thể. Để làm nổi bật chiếc áo cổ lọ này bạn\r\ncó thể lựa chọn vài <strong>phụ kiện thời trang</strong>\r\nđể làm chiếc áo cổ lọ thêm nổi bật. Một chiếc choker đơn giản được đính đá hay\r\nchiếc choker ngọc trai sẽ làm chiếc áo cổ lọ thêm nổi bật và sang trọng.</font></p><p><b><font size="3" color="#ff0099">7. \r\nMix vòng choker với áo cúp ngực</font></b></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/nhung-cach-mix-phu-kien-thoi-trang-vong-co-choker-da-mau-sac/nhungcachmixphukienthoitrangvongchokerdamausac7.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Áo cúp ngực ôm sát cơ thể\r\nlàm tôn vinh lên đôi gò bồng đảo căng tròn của người mặc, với lợi thể đó nhưng\r\nphần vai và cổ trở nên trống trải. Để tôn vinh lên phần cổ trắng, thon dài bạn\r\ncó thể mix cùng với vòng choker sát cổ để thu hút mọi ánh nhìn về phía bạn.</font></p><p>\r\n\r\n</p><p style="text-align: justify;"><font size="3">Với sự đa năng của vòng cổ\r\nchoker khi mix cùng nhiều loại trang phục nên danh xưng <strong>phụ kiện thời trang</strong> thời thượng, thần thánh quả không ngoa chút\r\nnào.</font></p></div>', 213, '2', '1', '2016-02-24 21:13:50', '2016-02-24 22:09:07', 1),
(6, '5 PHỤ KIỆN THỜI TRANG CHO NÀNG MẶT TRÁI XOAN', 'news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan4.jpg', 'Chỉ với 3 mách nhỏ trong việc lựa chọn phụ kiện thời trang, các nàng sở hữu khuôn mặt trái xoan sẽ thêm thời thượng và nổi bật giữa đám đông', '<p style="text-align: justify;"><strong><font size="3">Chỉ\r\nvới 3 mách nhỏ trong việc lựa chọn phụ kiện thời trang, các nàng sở hữu khuôn mặt\r\ntrái xoan sẽ thêm thời thượng và nổi bật giữa đám đông</font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Mỗi khuôn mặt sẽ có cách\r\ntrang điểm, kiểu tóc, <b>phụ kiện thời trang</b> phù hợp để tôn vinh lên những đường\r\nnét đẹp nhất. Khuôn mặt trái xoan hay khuôn mặt trái tim cũng thế, với vùng\r\ntrán rộng, cằm nhỏ gọn và khuôn mặt gọn về phía dưới nên lựa chọn những <b>phụ kiện\r\nthời trang</b> dáng mỏng, hay những <b>phụ kiện thời trang</b> tôn lên gò má duyên dáng.\r\nVà để giúp cho các quý cô tôn lên vẻ đẹp diễm lệ của khuôn mặt trái xoan hãy\r\ncùng <b>phukienthoitranggiare.xyz</b> tham khảo vài ý kiến để lựa chọn <b>phụ kiện thời\r\ntrang</b> phù hợp nhất.</font></p>\r\n\r\n<p><font size="3" color="#ff0099"><b>1. \r\nKẹp tóc</b></font></p><p style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan4.jpg" style="line-height: 1.42857;"><br></p><pclass="msonormal" style="text-align:justify"><p><font size="3">Kẹp tóc là sự lựa chọn hàng\r\nđầu cho cô nàng sở hữu khuôn mặt trái xoan, với thiết kế đơn giản, sang trọng,\r\nnữ tính sẽ tô điểm cho vẻ đẹp mái tóc của bạn. Bạn có thể lựa chọn những kẹp\r\ntóc nơ bé xinh, hay những hoa văn đơn giản đáng yêu đều phù hợp.</font></p><pclass="msolistparagraph" style="text-indent: -0.25in;"><b><font size="3" color="#ff0099">2. \r\nBăng đô/Cài tóc</font></b><p></p><p></p><p>\r\n\r\n</p></pclass="msolistparagraph"></pclass="msonormal"><div style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan.jpg" style="line-height: 1.42857;"><br></div><div style="text-align: center; "><p style="text-align: justify;"><font size="3">Băng đô hay cài tóc là một\r\ntrong những lựa chọn thông minh khi mix <b>phụ kiện thời trang</b> cho khuôn mặt trái\r\nxoan. Với việc sử dụng chiếc băng đô, phần tóc phía trên sẽ được tạo độ phồng ở\r\nhai bên nhằm che đi khuyết điểm phần trên khuôn mặt. Nhờ vào sự khóe léo mà mọi\r\nngười chỉ bị thu hút bởi khuôn mặt nhỏ nhắn, trẻ trung của bạn mà thôi.</font></p><p style="text-align: left;"><b><font size="3" color="#ff0099">3. Hoa tai dáng đèn chùm</font></b></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan5.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Với kết cấu khuôn mặt rộng\r\nphía trên trán và càng nhỏ gọn ở phần cằm thì việc lựa chọn những hoa tai dáng\r\nđèn chùm làm <b>phụ kiện thời trang</b> là một sự lựa chọn hoàn hảo. Với thiết kế cầu\r\nkỳ dạng đá lấp lánh, hay những hoa to nổi bật sẽ làm sáng khuôn mặt đồng thời\r\nlàm cho khuôn mặt trở nên cân đối hơn. Khi bạn đeo hoa tai để làm nổi bật cho\r\nkhuôn mặt thì cần bỏ qua những loại vòng cổ để đảm bảo sự nhẹ nhàng, tinh tế,\r\nkhông rườm rà.</font></p><p>\r\n\r\n</p><p style="text-align: justify;"><font size="3">Ngoài ra, bạn cũng cần tránh\r\nnhững đôi hoa tai có thiết kế rộng ở phía trên, hẹp phần dưới sẽ làm khuôn mặt\r\nngười dùng càng kém xinh.</font></p><p style="text-align: left;"><b><font size="3" color="#ff0099">4. \r\nHoa tai dáng dài</font></b></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: left;"><font size="3">Hoa tai dáng dài với thiết\r\nkiêu sa, lóng lánh sẽ làm cho khuôn mặt cô nàng trái xoan thêm xúng xính, xinh\r\nđẹp. Lựa chọn hoa tai dáng dài bạn có thể mix với mái tóc xoăn, tóc tết bím gọn\r\ngàng để lệch một bên, hay mái tóc búi cao kiểu cách.</font></p><p><img src="http://phukienthoitranggiare.xyz/public/image/news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan2.jpg" style="line-height: 1.42857;"></p><p style="text-align: left; "><font size="3" color="#ff0099"><b>5. \r\nHoa tai dạng hạt</b></font></p><pclass="msolistparagraph" style="text-align:justify;text-indent:-.25in;\r\nmso-list:l0 level1 lfo1"><p></p></pclass="msolistparagraph"></div><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/5-phu-kien-thoi-trang-cho-nang-mat-trai-xoan/5phukienthoitrangchonangmattraixoan3.jpg"></div><div class="postimg" style="text-align: center; "><p style="text-align: justify;"><font size="3">Với thiết kế đơn giản hoa\r\ntai dạng hạt sẽ mang đến cho khuôn mặt trái xoan phong cách vừa bán cổ điển, vừa\r\nhiện đại. Bạn có thể khóe léo mix hoa tai dạng hạt với cách trang điểm tông\r\nnude và màu son đỏ một cách nổi bật. Hoa tai ngọc trai là <b>phụ kiện thời trang</b> dạng\r\nhạt mà bạn có thể thêm vào bộ sưu tập của mình. Lưu ý, bạn đừng chọn hoa tai dạng\r\nhạt quá to sẽ làm khuôn mặt bạn tối đi.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Chỉ với vài mách nhỏ về <b>phụ\r\nkiện thời trang</b>, cô nàng sở hữu gương mặt trái xoan sẽ tự tin để tôn vinh lên\r\nnhững đường nét xinh đẹp, quý phái mà tạo hóa đã ban tặng.</font></p></div>', 134, '2', '1', '2016-02-24 21:45:45', '2016-02-24 22:08:37', 1),
(7, 'EAR CUFF - PHỤ KIỆN THỜI TRANG THĂNG HOA GUU CÁ TÍNH', 'news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh3.jpg', 'Ear Cuff không còn là phụ kiện thời trang thông thường mà nó dấy lên xu hướng thời trang có sức ảnh hưởng mạnh mẽ trên toàn thế giới, trong đó có cả các mỹ nhân Việt nhà ta.', '<p style="text-align: justify;"><strong><font size="3">Ear\r\nCuff không còn là phụ kiện thời trang thông thường mà nó dấy lên xu hướng thời\r\ntrang có sức ảnh hưởng mạnh mẽ trên toàn thế giới, trong đó có cả các mỹ nhân\r\nViệt nhà ta.</font></strong></p><div><p style="text-align: justify;"><font size="3">Các bé gái khi vừa sinh ra sẽ\r\nđược những người lớn trong gia đình xỏ tai để dễ dàng đeo những khuyên tai điệu\r\nđà. Nhưng chẳng may lại bỏ sót chuyện này thì quá ư là thiệt thòi vì không thể\r\nđeo khuyên tai hoặc chỉ có thể đeo những khuyên tai kẹp vành kiểu dáng đơn giản,\r\nnghèo nàn. Chính vì nhu cầu ấy mà sự ra đời của <b>Ear Cuff</b> đã thổi tan đi những định\r\nkiến cố hữu rằng chỉ có xỏ tai mới có thể làm điệu cho đôi tai xinh. </font></p>\r\n\r\n<p style="text-align: justify;"><font size="3"><b>Phụ kiện thời trang</b> - <b>Ear\r\nCuff</b> ra đời vào những năm 80 của thế kỷ trước, với chất liệu kim loại thiết kế\r\nôm sát vành tai, do đó người dùng không cần phải bấm lỗ. Ban đầu sự ra đời của\r\n<b>Ear Cuff</b> chỉ được dành cho những cô nàng đam mê\r\nphong cách rock chic hoặc punk rock nhưng ngày nay với sự đa dạng về kiểu dáng\r\nnữ tính, mềm mại bạn vẫn có thể sử dụng nó để kết hợp với những bộ cánh lãng mạn.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh11.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Ear Cuff đậm phong cách rock chic hoặc punk rock</i></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh4.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Một dạng khác của Ear Cuff</i></font></p><p style="text-align: justify;"><font size="3">So với khuyên tai thông thường, <b>Ear Cuff</b> được xem là <b>phụ kiện thời trang</b> rất đặc biệt vì người dùng có thể sử dụng mà không cần bấm lỗ tai, trang trí vành tai và thường đeo một bên tai để tránh đi sự nặng nề. Bên cạnh những ưu điểm tuyệt vời thì <b>phụ kiện thời trang Ear Cuff</b> có một khuyết điểm nhỏ là dễ bị tuột nếu nó bị vướng tóc hoặc chủ nhân vận động mạnh.</font></p><p style="text-align: justify;"><font size="3"><b>Ear Cuff</b> không còn là <b>phụ kiện thời trang</b> bình thường nữa mà nó đã trở thành guu thời trang cá tính của các mỹ nhân trên khắp thế giới. Chính vì lẽ đó hãy cùng <em><b>phukienthoitranggiare.xyz</b></em> điểm qua vài cách phối <b>Ear Cuff</b> của các mỹ nhân nhé!</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh2.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: left;"><font size="3">Cô nàng ca sĩ Alicia\r\nKeys khóe léo chọn cho mình Ear Cuff với 7 chiếc\r\nkhoen cá tính làm <b>phụ kiện thời trang</b> cùng mái tóc búi cao khóe léo khoe làn da\r\nbánh mật của cô.</font><br></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh10.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Cùng ý tưởng với Alicia Keys, cô nàng diễn viên, người mẫu\r\nkiêm ca sĩ người Mỹ&nbsp;Zoe Kravitz đã khóe léo diện <b>Ear Cuff</b> cùng hoa tai bản to\r\ntrong một sự kiện mà người đẹp này tham gia.</font><strong></strong></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh5.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Zoe Kravitz nổi bật với Ear Cuff dạng khoen</font></i><br></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh6.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Selita Ebanks – thiên thần của Victoria ‘s Secret với chiếc\r\near cuff cầu kỳ che phủ cả tai.</font></i><strong></strong></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh8.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Jessica Alba – nữ diễn\r\nviên người Mỹ tinh tế hơn với chiếc ear cuff uốn lượn</font></i><br></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh9.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Cô nàng ca sĩ, diễn viên người Anh Rita Ora lại mix ear cuff\r\nbằng vàng trên vành tai với đầm cúp ngực sang trọng và quý phái</font></i><strong></strong></p><p style="text-align: justify;"><font size="3">Không chỉ các mỹ nhân nước ngoài say đắm với phụ kiện thời\r\ntrang này mà các mỹ nhân Việt nhà ta cũng không kém cạnh khi mix cùng trang phục.</font><strong></strong></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Hòa nhập với xu hướng Ear Cuff, nữ hoàng giải trí Hà Hồ đã diện khuyên tai bản lớn hình lá mạ vàng với trang phục màu đỏ rực rỡ.</font></i><strong></strong></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh7.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Trong buổi ra mắt\r\nphim Mùa hè lạnh ở Hà Nội thì cô nàng hot girl Midu đã diện chiếc Ear Cuff nhỏ\r\nnhắn trên vành tai trái</font></i><br></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/ear-cuff-phu-kien-thoi-trang-doc-thang-hoa-guu-ca-tinh/earcuffphukienthoitrangdocthanghoaguucatinh1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Chim công làng múa Linh Nga\r\ncũng không kém cạnh khi diện Ear Cuff ôm khít vành tai lấp lánh trong một sự kiện\r\nmà cô tham gia.</font></i></p><p style="text-align: justify;"><font size="3"><b>Phụ kiện thời trang – Ear\r\nCuff</b> không chỉ tô thêm vẻ đẹp cho các mỹ nhân mà nó còn làm thăng hoa guu cá\r\ntính của người dùng. Vậy các tín đồ thời trang còn chần chừ gì mà không tậu cho\r\nmình một <b>Ear Cuff</b> độc đáo chứ! </font></p><p><br></p><p></p><p><br></p><p></p></div>', 207, '2', '1', '2016-02-26 19:38:18', '2016-02-26 19:38:18', 1),
(8, 'PHỤ KIỆN THỜI TRANG – MÓN QUÀ 8/3 ĐỘC ĐÁO CHO BẠN GÁI', 'news/83.jpg', 'Phụ kiện thời trang là một sự lựa chọn độc đáo trong bộ sưu tập quà tặng dành cho các nàng nhân dịp 8/3. Vài gợi ý nhỏ sẽ giúp cánh mày râu bớt đau đầu khi chọn quà.', '<p style="text-align: justify;"><strong><font size="3">Phụ kiện thời trang là một sự lựa chọn độc\r\nđáo trong bộ sưu tập quà tặng dành cho các nàng nhân dịp 8/3. Vài gợi ý nhỏ sẽ\r\ngiúp cánh mày râu bớt đau đầu khi chọn quà.</font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="3">8/3 là dịp để các đấng mày râu thể hiện tình cảm của\r\nmình dành tặng cho nửa kia của thế giới, đặc biệt là người mình yêu. Hoa tươi,\r\ngấu bông, nhẫn…thường là sự lựa chọn hàng đầu của các chàng bởi tính thông dụng\r\nvà dễ dàng tìm mua. Thế nhưng việc tặng quà năm nào cũng giống nhau đôi khi gây\r\nsự nhàm chán cho người nhận và các nàng hầu như không còn hào hứng với việc nhận\r\nquà nữa.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Chính vì những lý do đó mà hôm nay\r\n<b>phukienthoitranggiare.xyz</b> sẽ mách nước cho các chàng vài chiêu tặng quà cho\r\nnàng bất ngờ và cũng tiết kiệm một khoản kha khá cho túi tiền của các chàng.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3" color="#ff0099"><b>1. Dây chuyền</b></font></p><p style="text-align: justify;"><font size="3">Dây chuyền được xem là ưu tiên hàng đầu trong việc\r\nlựa chọn <b>phụ kiện thời trang</b>. Không cần phải là một sợi dây chuyền kim cương\r\nquý giá, hay một sợi dây chuyền ngọc trai điệu đà mà thay bằng một sợi dây bản\r\nto cách điệu với những đường nét hoa văn hài hòa cũng đủ làm cho các nàng run\r\nlên vì vui sướng.<br></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/phukienthoitranggiaredaychuyenhoavanvintage1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Sang trọng với dây chuyền hoa văn Vintage giả cổ</font></i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/phukienthoitranggiaredaychuyenhoaxenkegiaco.jpg" style="line-height: 18.5714px; text-align: start;"><i><font size="3"><br></font></i></p><p style="text-align: center;"><i style="font-size: medium; line-height: 1.42857;">Đáng yêu với dây chuyền lá xen kẽ giả cổ</i><br></p><p style="text-align: justify;"><font size="3">Hay những sợi dây chuyền statement bản to đính đá, ngọc\r\ntrai phá cách, hình học mạnh mẽ để các nàng có thể thoải mái mix cùng váy xinh\r\ndạo phố hay trang phục năng động, trẻ trung.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/phukienthoitranggiaredaychuyendaphoimautretrung1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Trẻ trung với dây chuyền đá phối màu</font></i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/phukienthoitranggiaredaychuyenlucgiacdinhngoc1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Phá cách với dây chuyền lục giác đính ngọc</font></i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/phukienthoitranggiaredaychuyenziczacden1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Cá tính với dây chuyền zic zắc đen</font></i></p><p style="text-align: justify;"><font size="3">Kiềng cổ ngọc trai hoặc kiềng cổ cách điệu cũng\r\nlà một sự lựa chọn đáng yêu dành cho những cô nàng ngọt ngào với phong cách tiểu\r\nthư.</font><i><font size="3"><br></font></i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/phukienthoitranggiarevongcodoicanhbac.jpg"><font size="3"><br></font></p><p style="text-align: center;"><font size="3"><span style="line-height: 22.8571px;"><i>Điệu đà với vòng cổ đôi cánh bạc</i></span></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/day-chuyen/large/saovietmemanmotkiengngocbaotinnhanh19.jpg"><font size="3"><span style="line-height: 22.8571px;"><i><br></i></span></font></p><p style="text-align: center;"><font size="3"><i>Phá cách với kiềng cổ ngọc trai</i></font></p><p><font size="3" color="#ff0099"><b>2.&nbsp;Cài áo</b></font></p><p style="text-align: justify;"><span style="line-height: 1.42857;"><font size="3">Nếu một nửa của bạn là cô nàng văn phòng, thường xuyên\r\nphải diện áo sơ mi và vest thì cài áo là <b>phụ kiện thời trang</b> thích hợp nhất.\r\nKhi nàng diện cài áo sẽ khác hẳn so với thường ngày đồng thời nàng sẽ luôn nhớ\r\nđến bạn mỗi khi nâng niu chiếc cài áo.</font></span></p><p style="text-align: justify;"><font size="3">Bạn có thể tặng nàng hẳn một bộ sưu tập cài áo. Để\r\nhàng ngày đi làm nàng có thêm sự lựa chọn, nếu cài áo dạng xích đơn, xích đôi\r\ncho áo sơ mi thì cài áo dạng đơn bản to giả cổ hoặc đính đá cho vest công sở.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/cai-ao/large/phukienthoitranggiarecaiaodoicanh(1).jpg"><font size="3"><br></font></p><p style="text-align: center;"><i><font size="3">Sáng tạo với cài áo đôi cánh</font></i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/cai-ao/large/phukienthoitranggiarecaiaotamgiacxichtam3.jpg" style="line-height: 18.5714px; text-align: start;"><i><font size="3"><br></font></i></p><p style="text-align: left;"><font size="3"><span style="line-height: 1.42857;"><b><font color="#ff0099">3. Vòng tay</font></b></span><br></font></p><p style="text-align: justify;"><font size="3">Nếu bạn yêu một cô nàng teen nhí nhảnh, đáng yêu thì\r\nvòng tay là <b>phụ kiện thời trang</b> hợp với lễ 8/3 nhất. Một chiếc vòng tay\r\nhandmade làm bằng da với những mặt đồng giả cổ siêu đáng yêu sẽ rất phù hợp với\r\nnhững bộ trang phục xì teen, đáng yêu hoặc bụi bặm.</font></p><p style="text-align: justify;"><font size="3">Bạn có thể tặng nàng một cái và làm nàng bất ngờ khi\r\nhôm sau mình cũng diện đồng điệu giống nàng để chứng minh cho nàng thấy nàng và\r\nchàng là một cặp. Ngoài ra như cũng nhằm khẳng định rằng nàng là của chàng, đừng\r\ncó anh chàng nào me me đến gần nàng đấy nhé!</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/vong-tay/large/phukienthoitranggiarevongtaydahatgomaumatngoisaodinhhat.jpg"><font size="3"><br></font></p><div style="text-align: center;"><font size="3"><span style="line-height: 1.42857;">&nbsp;</span><span style="text-align: center; line-height: 1.42857;">Vòng tay da hạt gỗ màu, mặt ngôi sao đính hạt siêu đáng yêu</span></font></div><div style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/product/vong-tay/large/phukienthoitranggiarevongtaychapdonghochulovekhoatay2.jpg"><span style="text-align: center; line-height: 1.42857;"><br></span></div><div style="text-align: center;"><span style="text-align: center; line-height: 1.42857;"><font size="3">Chung đôi cùng vòng da handmade</font></span></div><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p style="text-align: justify;"><font size="3">Với vài lời mách nhỏ <b>phukienthoitranggiare.xyz</b> tin rằng\r\nbạn sẽ lựa chọn được một món quà ưng ý dành tặng cho bạn gái nhân dịp 8/3. Quà\r\ntặng không quan trọng vật chất mà quan trọng là người tặng đã dành hết tình cảm\r\ntâm tư cho món quà. Lời cuối cùng <b>phukienthoitranggiare.xyz </b>gửi lời chúc đến tất\r\ncả phụ nữ trên thế giới có một ngày 8/3 vui vẻ, hạnh phúc và nhận được món quà\r\ntừ nửa yêu thương của mình.</font><a></a></p><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div>', 168, '2', '1', '2016-03-03 15:50:16', '2016-03-05 14:15:30', 1),
(9, 'HỌC LÕM CÁCH MIX PHỤ KIỆN THỜI TRANG NGỌC TRAI CỦA CÁC SAO', 'news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao4.jpg', 'Nhắc đến ngọc trai thường đi đôi với định kiến là loại phụ kiện thời trang chỉ hợp với những người luống tuổi. Hãy xóa đi ý nghĩ này nếu bạn đọc bài viết dưới đây.', '<p style="text-align: justify;"><strong><font size="3">Nhắc\r\nđến ngọc trai thường đi đôi với định kiến là loại phụ kiện thời trang chỉ hợp với\r\nnhững người luống tuổi. Hãy xóa đi ý nghĩ này nếu bạn đọc bài viết dưới đây.</font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="3"><b>Phụ kiện thời trang</b> <b>ngọc\r\ntrai</b> được xem là loại trang sức không tuổi, nó đã vượt xa hơn các xu hướng thời\r\ntrang, các mùa và được ứng dụng mạnh mẽ của giới trẻ với các set đồ sành điệu. </font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Với sự cách tân ngày càng mạnh\r\nmẽ về kiểu dáng, kết cấu, sự kết hợp với các chất liệu khác, <b>phụ kiện thời\r\ntrang ngọc trai</b> đã làm xiêu lòng tất cả các tín đồ thời trang trên toàn thế giới.\r\nNgoài ra, <b>ngọc trai</b> không kén người dùng và luôn tạo cho chủ nhân của nó một vẻ\r\nđẹp sang trọng, quý phái, thời thượng nên nó vẫn là ưu tiên số một trong các bữa\r\ntiệc trọng đại, sự kiện quan trọng. </font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Không chỉ các mỹ nhân thế giới\r\nbị “hớp hồn” bởi sự trơn, bóng của những viên ngọc mà các mỹ nhân Việt nhà ta\r\ncũng không thoát khỏi sức hút khó cưỡng này. Điểm qua vài cách mix trang phục với\r\n<b>phụ kiện thời trang ngọc trai</b> của các sao nhà ta để “học lõm” nào!</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3" color="#ff0099"><b>1. \r\nVòng cổ ngọc trai truyền thống</b></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3"><b>Vòng cổ ngọc trai</b> dạng chuỗi\r\nđơn hoặc dạng chuỗi đôi là <b>phụ kiện thời trang</b> truyền thống của <b>ngọc trai</b>. Tuy\r\nnhiên nếu biết cách mix trang phục không những không đơn điệu mà tạo hiệu ứng\r\nvô cùng sang trọng, quý phái cho người mặc. Hãy điểm qua vài cách mix <b>vòng cổ\r\nngọc trai</b> của các mỹ nhân nhé!</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao2.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Với dạng đầm kiểu cúp ngực,\r\nhoa hậu Mai Phương Thúy đã khóe léo chọn cho mình <b>vòng cổ ngọc trai</b> dạng trơn\r\nđơn giản, hay điểm bằng mặt bé xinh vừa khóe léo khoe chiếc cổ trắng ngần, vừa\r\ngiảm bớt trống trải phía trước ngực.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Với thiết kế đơn giản nhiều\r\ntầng cô “Bống” Hồng Nhung lại mix <b>phụ kiện thời trang ngọc trai</b> với chiếc áo\r\ndài truyền thống vừa mang nét cổ điển nhưng lại vô cùng sang trọng, tinh tế của\r\ncô gái Việt Nam.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3">Lý Nhã Kỳ là người đẹp thường\r\nxuyên mix <b>phụ kiện thời trang ngọc trai</b> với những bộ cánh cổ điển, sang trọng của\r\nmình. Điều đó vừa khẳng định vẻ đẹp vốn có, vừa thể hiện quyền lực của một quý\r\ncô xuất thân từ gia đình quyền quý, cao sang.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao7.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3" color="#ff0099"><b>2. \r\nVòng cổ ngọc trai dạng kiềng.</b></font></p><p>\r\n\r\n</p><p style="text-align: justify;"><font size="3">Vòng cổ ngọc trai dạng kiềng\r\nlà sự biến tấu vô cùng đáng yêu của <b>phụ kiện thời trang ngọc trai</b>, nó được xem\r\nlà sự kết hợp giữa kiềng cổ và <b>ngọc trai</b>. Chính sự mới lạ và độc đáo của mình\r\nmà các mỹ nhân Việt nhà ta thay phiên lăng xê với sự kết hợp từ dịu dàng đến cá\r\ntính.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao8.jpg"><font size="3"><br></font></p><pclass="msonormal" style="text-align:justify"><div style="text-align: center;"><span style="font-size: medium; line-height: 1.42857;"><i>Vẻ đẹp ngọt ngào của nữ\r\nhoàng nội y Ngọc Trinh khi mix kiềng ngọc trai với váy quây màu sắc.</i></span></div><div style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao6.jpg" style="line-height: 1.42857;"><br></div><div style="text-align: center;"><span style="font-size: medium; text-align: justify; line-height: 1.42857;"><i>Hay người đẹp Giáng My thanh\r\nlịch, quý phái với chiếc đầm phong cách cổ điển mix cùng kiềng ngọc trai và\r\nvòng tay ngọc trai.</i></span><br></div><div style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao9.jpg"><span style="font-size: medium; text-align: justify; line-height: 1.42857;"><i><br></i></span></div><div style="text-align: center;"><i style="font-size: medium; line-height: 1.42857;">Tóc Tiên lém lỉnh và cá tính\r\nvới áo hở vai, quần baggy và kiềng cổ ngọc trai, trông cô vừa cá tính nhưng lại\r\nvô cùng dịu dàng và nền nã.</i><br></div><div style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao5.jpeg"><i style="font-size: medium; line-height: 1.42857;"><br></i></div><div style="text-align: center;"><font size="3">Trang Khiếu lạ lẫm với kiềng cổ ngọc trai trong bộ ảnh mới</font></div><font size="3"><p><b><font color="#ff0099">3. \r\nVòng cổ ngọc trai statement.</font></b></p><p>Bên cạnh <b>vòng cổ ngọc trai</b>\r\ntruyền thống hay vòng cổ dạng kiềng thì <b>vòng cổ statement ngọc trai</b> chưa bao giờ\r\nlỗi mode. Với sự biến tấu thêm những chi tiết metalic sành điệu, các sao Việt\r\nnhà ta thường mix với đầm liền suông hay đầm liền ôm sát quyến rũ</p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao10.jpg"><br></p><p>Vòng cổ ngọc trai cách điệu\r\ncủa Ngọc Trinh vô cùng đáng yêu khi kết hợp với áo croptop và chân váy xòe hay nhí nhảnh khi mix cùng jump suit nổi bật</p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao11.jpg"><br></p><p>Cô nàng ca sĩ Văn Mai Hương\r\nlại khóe léo chọn vòng cổ ngọc trai statement sợi nhỏ để làm nổi bật chiếc váy\r\ncổ yếm độc đáo của mình</p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/oclomcachmixphukienngoctraicuacacsao12.jpg"><br></p><p style="text-align: center;"><i>...và khi dịu dàng trong sắc áo màu ghi</i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/hoc-lom-cach-mix-phu-kien-thoi-trang-ngoc-trai-cua-sao-viet/hoclomcachmixphukienngoctraicuacacsao3.jpg"><br></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p>Với vài chiêu mix phụ kiện\r\nthời trang ngọc trai bạn sẽ vô cùng xinh đẹp, đáng yêu như các sao nhà ta mà không lo bị cộng thêm tuổi nào nhé!</p></font></pclass="msonormal"><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div>', 189, '2', '1', '2016-03-05 15:04:44', '2016-03-05 15:11:36', 1);
INSERT INTO `news` (`id`, `name`, `image`, `description`, `content`, `view`, `user`, `categoryNewsID`, `created_at`, `updated_at`, `display`) VALUES
(10, 'DIỆN BIKINI HÚT MẮT VỚI  5 PHỤ KIỆN THỜI TRANG', 'news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang19.jpg', 'Phụ kiện thời trang không thích hợp để diện chung với bikini là điều hoàn toàn sai lầm, chỉ cần khóe léo trong cách mix trang phục thì còn gì bằng để thiêu đốt mọi ánh nhìn.', '<p style="text-align: justify;"><strong><font size="3">Phụ\r\nkiện thời trang không thích hợp để diện chung với bikini là điều hoàn toàn sai\r\nlầm, chỉ cần khóe léo trong cách mix trang phục thì còn gì bằng để thiêu đốt mọi\r\nánh nhìn.</font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Bikini hai mảnh là trang phục\r\nmà các nàng lựa chọn nhiều nhất khi đi biển, ngoài việc thuận tiện cho các hoạt\r\nđộng ở biển thì việc khóe léo tôn vinh dáng ngọc là điều mà các chị em phụ nữ\r\nquan tâm. Một đôi gò bồng đảo căng tròn, một vòng eo con kiến và một đôi chân\r\nthon dài sẽ thật tuyệt để diện bikini, tuy nhiên không phải ai cũng sở hữu một\r\nthân hình tuyệt mỹ như thế và vấn đề đặt ra là làm sao với một thân hình không\r\nhoàn mỹ vẫn có thể tự tin diện bikini.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3"><strong>Phụ\r\nkiện thời trang</strong> tuy không thể che lấp những khuyết điểm trên\r\ncơ thể nhưng nó lại có tác dụng thu hút mọi ánh nhìn vào chỗ đẹp nhất trên cơ\r\nthể của bạn, đồng thời làm bạn khác biệt so với các cô gái khác. Chính vì lý do\r\nđó mà hôm nay <strong>phukienthoitranggiare.xyz</strong>\r\nchia sẻ vài bí quyết giúp bạn mặc bikini đẹp hơn.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3"><strong>1. </strong><strong>Dây chuyền phong cách Bohamin</strong></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Dây chuyền phong cách\r\nBohamin là <strong>phụ kiện thời trang</strong> mang\r\nphong cách thổ dân với họa tiết màu sắc cầu kỳ. Với thiết kế đẹp mắt, bắt nắng\r\nnên khi vui đùa dưới làn nắng biển trông các nàng càng thêm bắt mắt và quyến\r\nrũ. Ngoài ra, một chiếc vòng cổ bản to có khả năng che bớt đi những khoản trống\r\ntrên khuôn ngực giúp hạn chế việc tố cáo khuôn ngực bạn không căng tròn.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang14.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><i><font size="3">Vòng cổ Bohamin bản to</font></i></p><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang11.jpg"></div><div class="postimg" style="text-align: center; "><i><font size="3">Kết hợp vòng cổ và thắt lưng</font></i></div><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang2.jpg" style="line-height: 1.42857;"><br></div><div class="postimg" style="text-align: center; "><p style="text-align: left;"><font size="3">Ngoài ra, bạn có thể diện dạng\r\ndây chuyền kéo dài tới phần hông sẽ trông khá đẹp mắt, đồng thời kết hợp giữa\r\ndây chuyền ở vòng cổ và vòng eo.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang5.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Bikini xanh hợp màu với đá xanh</i></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang7.jpg"><font size="3"><i><br></i></font></p><p style="text-align: left;"><font size="3"><strong>2. </strong><strong>Vòng đeo bắp tay</strong></font></p><p>\r\n\r\n</p><p style="text-align: justify;"><font size="3">Thông thường vòng tay được\r\nđeo ở cổ tay, nhưng bạn vẫn có thể vô tư diện <strong>phụ kiện thời trang</strong> tại bắp tay nếu bạn sở hữu phần bắp tay thon gọn,\r\nsăn chắc. Diện <strong>phụ kiện thời trang</strong>\r\nôm lấy phần bắp tay sẽ làm bạn trở nên năng động và cá tính khi diện cùng\r\nbikini</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang1.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Vòng đeo bắp tay dạng xích và chuỗi</i></font></p></div><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang12.jpg"></div><div class="postimg" style="text-align: center; "><p style="text-align: left;"><font size="3"><strong>3. </strong><strong>Vòng đeo ở hông</strong></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Đeo <strong>phụ kiện thời trang</strong> ở phần hông từng rất hot ở những năm 90, tuy\r\nnhiên gần chục năm dường như các nàng đã lãng quên. Khi diện bikini, bạn có thể\r\nkết hợp thêm để trang phục thêm “lồng lộn” đúng chất hoàng gia bằng các kiểu\r\nvòng cầu kỳ. Bộ bikini của bạn sẽ thêm một đẳng cấp mới. </font></p></div><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang13.jpg" style="line-height: 1.42857;"><br></div><div class="postimg" style="text-align: center; "><font size="3"><i>Đáng yêu với vòng đeo hông ngôi sao</i></font></div><div class="postimg" style="text-align: center; "><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang6.jpg"><font size="3"><i><br></i></font></div><div class="postimg" style="text-align: left;"><strong style="font-size: medium; text-align: justify; line-height: 1.42857;">4. </strong><strong style="font-size: medium; text-align: justify; line-height: 1.42857;">Vòng đeo quanh đùi</strong><br></div><div class="postimg" style="text-align: center; ">\r\n\r\n<p style="text-align: justify;"><font size="3">Đã bao\r\ngiờ bạn nghĩ đến việc đeo <strong>phụ kiện thời\r\ntrang</strong> cho đùi chưa? Nghe thì hơi kỳ cục nhưng hiệu quả mang lại thì chất lắm\r\nnhé. Các kiểu vòng xích mảnh nhiều lớp ôm quanh đùi này đặc biệt thích hợp khi\r\nbạn diện quần shorts hay bikini đấy nhé!</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang15.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Quyến rũ với vòng quanh chân dạng xích đôi gắn mặt kim loại</i></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang9.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: justify;"><font size="3"><strong>5. </strong><strong>Vòng đeo chân</strong></font></p><p>\r\n\r\n</p><p style="text-align: justify;"><font size="3">Với sự phát triển của <strong>phụ kiện thời trang</strong>, các kiểu vòng đeo\r\nchân ngày càng đa dạng, cầu kỳ về kiểu cách. Diện vòng chân dạng đơn hoặc những\r\nvòng chân xỏ ngón sẽ làm cho đôi chân trần trên cát của bạn thêm phần sinh động\r\nvà cầu kỳ. Bạn có thể diện vòng chân có gắn nhiều lục lạc để gây thêm tiếng\r\nleng keng vui tai khi bạn di chuyển trên cát.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang16.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Cầu kỳ với vòng chân xỏ ngón</i></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang3.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>...kiểu cách với dạng lưới</i></font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/dien-bikini-hut-mat-voi-5-phu-kien-thoi-trang/dienbikinihutmatvoi5phukienthoitrang18.jpg" style="line-height: 1.42857;"><br></p><p style="text-align: center;"><font size="3"><i>Phá cách với vòng chân dạng đính đá</i></font></p><p style="text-align: justify;"><font size="3">Diện <strong>phụ kiện thời trang</strong> đúng cách không chỉ tạo “guu” thời trang cho\r\nriêng bạn mà còn làm bạn thêm rạng rỡ, xinh đẹp ngay cả dưới cái nắng hè gay gắt\r\nnữa.</font></p></div><div class="postimg" style="text-align: justify;"><br></div>', 184, '2', '1', '2016-03-05 19:50:52', '2016-03-06 11:51:04', 1),
(11, 'PHỤ KIỆN THỜI TRANG CHẤT LỪ CỦA DÀN SAO HẬU DUỆ MẶT TRỜI KHIẾN FAN ĐIÊN ĐẢO', 'news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao9.jpg', 'Dù chỉ mới lên sóng nhưng fan đã kịp soi những phụ kiện thời trang giá rẻ, chất lừ của cặp đôi sao chính Song Hye Kyo và Song Joong Ki trong Hậu duệ mặt trời.', '<p style="text-align: justify;"><strong><font size="3">Dù\r\nchỉ mới lên sóng nhưng fan đã kịp soi những phụ kiện thời trang giá rẻ, chất lừ\r\ncủa cặp đôi sao chính Song Hye Kyo và Song Joong Ki trong Hậu duệ mặt trời </font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Bộ phim Hậu duệ mặt trời (Descendants of the Sun) là một\r\ncâu chuyện tình lãng mạn giữa cô nàng bác sĩ Kang Mo Yeon do Song Hye Kyo thủ\r\nvai và anh chàng đại úy Shi Jin do Song Joong Ki thủ vai. Nếu như cô nàng bác\r\nsĩ mang đến vẻ đẹp ngọt ngào, mong manh với guu thời trang nhẹ nhàng, tinh tế\r\nthì anh chàng bác sĩ với vẻ ngoài nam tính, mạnh mẽ. Đặc biệt, <b>phụ kiện thời\r\ntrang</b> giá rẻ, cực chất của cặp đôi ngọc nữ, mỹ nam đã làm cho các fan phải điêu\r\nđứng. Nào hãy cùng <b>phukienthoitranggiare.xyz</b> điểm qua những phụ kiện thời trang\r\nnày nhé!</font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Hoa tai là <b>phụ kiện thời trang </b>mà cô nàng bác sĩ Kang Mo Yeon\r\nđược nhắc đến nhiều nhất, với thiết kế chủ đạo đơn giản, màu trắng nên rất phù\r\nhợp cô nàng trong công việc của mình.</font></p>\r\n\r\n<p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao4.jpg"><font size="3"><br></font></p><p style="text-align: justify;"><font size="3">Đôi hoa tai tam giác dạng khối đính đá đến từ thương hiệu J.estina (Hàn Quốc) có tên Tre Raggio Hélio có giá khoảng 2 triệu đồng làm cho cô nàng trở nên đơn giản và thanh lịch.</font><br></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao.jpg"><font size="3"><br></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Ngoài ra phải kể đến đôi hoa tai dạng móc câu màu trắng cá\r\ntính đến từ thương hiệu Aino của Hàn Quốc với thiết kế nhỏ và thanh mảnh với\r\ngiá 1 triệu đồng được cô nàng diện với những bộ cánh trẻ trung, thanh lịch.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao2.jpg"><font size="3"><br></font></p><p style="text-align: center;"><i><font size="3">Cá tính với đôi hoa tai móc câu</font></i></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao3.jpg" style="line-height: 18.5714px; text-align: start;"><i><font size="3"><br></font></i></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Với chiếc áo blue màu trắng, cô nàng bác sĩ vô cùng khóe léo\r\nkhi mix tur sur tone với đôi hoa tai trắng của thương hiệu Aino có giá 1,2 triệu\r\nđồng.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao8.jpg"><font size="3"><br></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Bên cạnh những mẫu hoa tai ngắn thì mẫu hoa tai dáng dài,\r\nđính đá cũng là một trong những item mà cô nàng này ưa thích. Nếu hoa tai ngắn\r\nmang đến sự đơn giản, trẻ trung thì hoa tai dáng dài lại mang đến sự dịu dàng,\r\nnữ tính cho cô nàng.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao5.jpg"><font size="3"><br></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Đôi hoa tai đính đá có tên Moonlight của thương hiệu H.Stern\r\ncó giá khoảng 2 triệu đồng với thiết kế 3 viên đá dạng dọc và điểm ở phần đuôi\r\nhoa tai là hình ông mặt trời xinh xắn.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao7.jpg"><font size="3"><br></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Sự kết hợp giữa ngọc trai và đá cũng là một trong những <b>phụ\r\nkiện thời trang</b> mà cô nàng lựa chọn, với thiết kế của thương hiệu H.Stern thì\r\nDiane von Furstenberg là một sự lựa chọn chính xác.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao6.jpg"><font size="3"><br></font></p><p style="text-align: center;"><font size="3"><i>Dịu dàng và nền nã với hoa tai dáng dài</i></font></p><p style="text-align: justify;"><span style="font-size: medium; line-height: 1.42857;">Bên cạnh những mẫu hoa tai thường thấy, thì những mẫu hoa tai\r\nđộc lạ cũng được các fan xăm soi khá kỹ. Đôi hoa tai chữ thập có giá khoảng 3,5\r\ntriệu đồng kết hợp cùng đôi hoa tai dáng mảnh có giá khoảng hơn 900 ngàn cũng\r\nđược cô nàng lựa chọn khi hẹn hò cùng Song Joong Ki.</span><br></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao10.jpg"><span style="font-size: medium; line-height: 1.42857;"><br></span></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Đôi hoa tai tròn, nhỏ xinh với thiết kế hình tam giác nhỏ\r\nđính xung quanh với cái tên đáng yêu Triple Rolling E với giá 1,3 triệu đồng của\r\nthương hiệu AiNO.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao1.jpg"><font size="3"><br></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Nếu như cô nàng bác sĩ nổi bật</font><span style="font-size: medium; line-height: 1.42857;">&nbsp;với những đôi hoa tai thì anh chàng đại úy điển trai do Song Joong Ki thủ vai\r\ncũng không kém cạnh với những </span><b style="font-size: medium; line-height: 1.42857;">phụ kiện thời trang</b><span style="font-size: medium; line-height: 1.42857;"> dành cho cánh mày râu cho vẻ\r\nngài cực chất nhưng vẫn nam tính và mạnh mẽ.</span></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao11.jpg"><span style="font-size: medium; line-height: 1.42857;"><br></span></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Với áo len kẻ tay anh chàng\r\nđã khóe léo mix cùng chiếc đồng hồ phong cách đơn giản nhưng ấn tượng có tên là\r\nBreitling Navitimer Stainless Steel có giá khoảng 135 triệu đồng. Tuy đơn giản\r\nnhưng anh chàng hoàn toàn thu hút bất cứ mọi ánh nhìn.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao13.jpg"></p>\r\n\r\n<p style="text-align: justify;"><font size="3">Vòng tay đậm chất handmade lại\r\nđược anh chàng mix cùng áo sơ mi, quần tây âu vô cùng lịch lãm, sang trọng\r\nnhưng đáng yêu và cá tính.</font></p><p style="text-align: center;"><img src="http://phukienthoitranggiare.xyz/public/image/news/1/phukienthoitrangchatlucuadansaohauduemattroikhienfandiendao12.jpg"><font size="3"><br></font></p>\r\n\r\n<p style="text-align: justify;"><font size="3"><b>Phụ kiện thời trang</b> tuy nhỏ\r\nnhưng là điểm nhấn đặc biệt làm cho các set đồ của hai nhân vật và làm cho tính\r\ncách nhân vật được phần nào khắc họa rõ nét hơn.</font></p><p style="text-align: justify;"><br></p><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div><div class="postimg"><br></div>', 309, '2', '1', '2016-03-10 20:08:00', '2016-03-10 20:08:00', 1),
(12, 'Nhẫn midi – Không thể bỏ qua nếu bạn là fashionista thực thụ', 'news/nhan-midi-khong-the-bo-qua-neu-ban-la-fashionista-thuc-thu/nhanmidi11.jpg', 'Midi ring, nhẫn đeo ở khớp thứ 2 của ngón tay không còn xa lạ với các tín đồ thời trang bởi sự sành điệu, mới mẻ và mode đúng chất không lẫn vào đâu được.', '<p style="text-align: justify;"><strong><font size="4">Midi\r\nring, nhẫn đeo ở khớp thứ 2 của ngón tay không còn xa lạ với các tín đồ thời\r\ntrang bởi sự sành điệu, mới mẻ và mode đúng chất không lẫn vào đâu được.</font></strong></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Nếu như trước đây bạn sở\r\nhữu những chiếc nhẫn không vừa tay, chỉ vội đem tặng hay vứt chúng đi thì bây\r\ngiờ đã trở thành xu hướng “hot” mà giới thời trang không ngừng săn lùng. Midi\r\nring hay còn gọi là nhẫn midi được thiết kế để đeo ở khớp thứ 2 của các ngón\r\ntay, vừa tạo điểm nhấn, vừa làm cho đôi tay trở nên sinh động và duyên dáng\r\nhơn.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Midi ring thường có thiết\r\nkế mảnh, freesize để người sử dụng dễ dàng thay đổi độ lớn, nhỏ sao cho phù hợp\r\nvới kích thước của các ngón tay. Với sự phát triển của ngành thời trang, ngành\r\nphụ kiện thời trang cũng phát triển không kém tiêu biểu là sự thăng tiến của\r\nmode midi ring. </font></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Midi ring được thiết kế\r\nvới nhiều dạng khác nhau phù hợp với mục đích thời trang mà bạn hướng tới. Nào hãy\r\ncùng phukienthoitranggiare.xyz điểm qua vài thiết kế của loại phụ kiện thời trang\r\n“chất lừ” này nhé!</font></p>\r\n\r\n<p style="text-align: justify;"><font size="4" color="#ff0099"><b>1. \r\nMidi ring dạng đơn</b></font></p><p style="text-align: justify;"><span style="font-size: large; line-height: 1.42857;">Midi ring dạng đơn là một\r\ntrong những thiết kế thường thấy nhất của dạng phụ kiện thời trang loại này. Với\r\nthiết kế mảnh mai, có kẻ hỡ để dễ dàng thay đổi kích thước, giúp cho người dùng\r\nthoải mái đeo ở tất cả vị trí của các ngón tay. Nếu bạn yêu thích “guu” thời\r\ntrang tiểu thư thì đây là lựa chọn mà không nên bỏ qua, bạn có thể mix thêm bằng\r\nviệc tô điểm những móng tay bằng những snail màu sắc tươi sáng thì quá ư là tuyệt\r\nvời.</span></p>\r\n\r\n<p style="text-align: justify;"><font size="4" color="#ff0099"><b>2. \r\nMidi ring dạng đôi</b></font></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Midi ring dạng đôi cũng\r\nlà một dạng của nhẫn midi nữa đấy. Với hai chiếc nhẫn giống nhau về kiểu dáng,\r\nchất liệu nhưng khác kích thước bạn có thể đeo cùng một ngón tay. Midi ring dạng\r\nnày có thiết kế dạng bản to, trơn bóng hay thiết kế dạng song song làm cho midi\r\nring trở nên mềm mại hơn. Những kiểu lượn sóng, chữ V, hình học… cũng là một\r\ntrong những lựa chọn mà midi ring hướng tới.</font></p>\r\n\r\n<p style="text-align: justify;"><font size="4" color="#ff0099"><b>3. \r\nMidi ring dạng nối xích, trang trí họa\r\ntiết</b></font></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Midi ring với những họa\r\ntiết treo lủng lẳng, dây xích…cũng mang lại làn gió mới cho midi ring. Hay bạn\r\nvẫn có thể lựa chọn những chiếc midi ring có hình thù ngộ nghĩnh, màu sắc nổi bật\r\nđể làm điệu cho những ngón tay của bạn. </font></p>\r\n\r\n<p style="text-align: justify;"><font size="4" color="#ff0099"><b>4. \r\nMidi ring dạng set bộ</b></font></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Midi ring dạng bộ thường\r\nlà tập hợp từ 3 đến 6 chiếc với kiểu dáng giống nhau hoặc khác nhau. Bạn có thể\r\nthoải mái lựa chọn đeo vài chiếc để tạo nên phong cách tiểu thư hay có thể đeo\r\nhết cả bộ để tạo nên style chất ngầu, nổi loạn. </font></p>\r\n\r\n<p style="text-align: justify;"><font size="4">Midi ring – một mode thời\r\ntrang chất lừ mà các tín đồ thời trang vô cùng yêu thích, săn lùng, bên cạnh đó\r\nmidi ring là bước chuyển mình đáng nói khi kiểu nhẫn này đã vượt qua định kiến của\r\nkiểu nhẫn truyền thống, chỉ đeo được ở sát bàn tay. </font></p>', 35, '2', '1', '2016-04-28 21:17:51', '2016-04-28 21:17:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `menuid` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `content`, `view`, `menuid`, `created_at`, `updated_at`, `url`) VALUES
(4, 'thanh toán', 'trang thanh toán', 0, 0, '2016-11-26 11:16:08', '2016-11-26 11:16:08', 'thanh-toan'),
(5, 'Giới thiệu', 'trang giới thiệu', 0, 0, '2016-11-26 11:16:24', '2016-11-26 11:16:24', 'gioi-thieu');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promotion_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `user` int(11) NOT NULL,
  `tab_categoryID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `tagID` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menuID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `display` tinyint(4) NOT NULL,
  `bin` tinyint(4) NOT NULL,
  `original_price` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=108 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `promotion_price`, `price`, `image`, `quantity`, `status`, `view`, `content`, `user`, `tab_categoryID`, `categoryID`, `tagID`, `menuID`, `created_at`, `updated_at`, `display`, `bin`, `original_price`) VALUES
(102, 'THIỆP CƯỚI C10', '2300', '3000', 'product/20140904043021thiepcuoideph42.jpg', 1, 'new', 50, '', 1, 1, 11, '', 1, '2016-11-26 11:00:40', '2016-11-26 11:00:40', 1, 0, '1000'),
(103, 'THIỆP CƯỚI TV71', '3000', '2300', 'product/thiepcuoic1014689790959fpjcp.jpg', 1, 'new', 30, '', 1, 1, 12, '', 1, '2016-11-26 11:03:59', '2016-11-26 11:03:59', 1, 0, '1000'),
(104, 'Thiệp cưới H47', '3000', '2000', 'product/20140904044630thiepcuoideph47.jpg', 1, 'new', 24, '', 1, 1, 13, '', 1, '2016-11-26 11:07:07', '2016-11-26 11:07:07', 1, 0, '1000'),
(105, 'Thiệp cưới MP187', '1500', '2000', 'product/thiepcuoimp4914690082119yfrnx.jpg', 1, 'new', 42, '', 1, 0, 14, '', 0, '2016-11-26 11:09:46', '2016-11-26 11:22:43', 1, 0, '1000'),
(106, 'THIỆP CƯỚI C20', '2000', '3000', 'product/thiepcuoic2014689812299my84d.jpg', 1, 'new', 26, '', 1, 1, 15, '', 1, '2016-11-26 11:20:04', '2016-11-26 11:20:04', 1, 0, '1000'),
(107, 'THIỆP CƯỚI MP611', '2500', '4000', 'product/thiepcuoimp6111469160826geazqr.jpg', 1, 'new', 17, '', 1, 1, 16, '', 1, '2016-11-26 11:21:44', '2016-11-26 11:21:44', 1, 0, '1000');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `name`, `image`, `content`, `url`, `page`, `created_at`, `updated_at`) VALUES
(8, '2', 'slide/20140826033946slide01.jpg', '', '', '0', '2016-03-15 20:15:10', '2016-11-26 11:06:10'),
(9, '3', 'slide/20140826034013slide02.jpg', '', '', '0', '2016-03-15 20:18:08', '2016-11-26 11:06:04'),
(10, '1', 'slide/20140826034043slide03.jpg', '', '', '0', '2016-03-16 21:23:21', '2016-11-26 11:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `tab_category`
--

CREATE TABLE IF NOT EXISTS `tab_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
