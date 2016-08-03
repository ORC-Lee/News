-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-29 04:18:43
-- 服务器版本： 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imooc_singcms`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_admin`
--

CREATE TABLE `cms_admin` (
  `admin_id` mediumint(6) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `lastloginip` varchar(15) DEFAULT '0',
  `lastlogintime` int(10) UNSIGNED DEFAULT '0',
  `email` varchar(40) DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_admin`
--

INSERT INTO `cms_admin` (`admin_id`, `username`, `password`, `lastloginip`, `lastlogintime`, `email`, `realname`, `status`) VALUES
(1, 'admin', 'd099d126030d3207ba102efa8e60630a', '0', 1461135752, 'tracywxh0830@126.com', '张三', 1);

-- --------------------------------------------------------

--
-- 表的结构 `cms_menu`
--

CREATE TABLE `cms_menu` (
  `menu_id` smallint(6) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cms_news`
--

CREATE TABLE `cms_news` (
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `catid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(30) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) DEFAULT NULL COMMENT AS `标题颜色`,
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL COMMENT '文章描述',
  `posids` varchar(250) NOT NULL DEFAULT '',
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT AS `来源`,
  `username` char(20) NOT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_news`
--

INSERT INTO `cms_news` (`news_id`, `catid`, `title`, `small_title`, `title_font_color`, `thumb`, `keywords`, `description`, `posids`, `listorder`, `status`, `copyfrom`, `username`, `create_time`, `update_time`, `count`) VALUES
(27, 12, '萌萌的玉兔号月球车跟人类说了再见：她再也不会醒来了', '玉兔号月球车跟人类说了再见', '#ed568b', 'upload/2016/08/03/57a1a3d539ef5.jpg', '玉兔号 月球车 再见', '玉兔号月球车跟人类说了再见', '', 0, 1, '1', 'admin', 1470211070, 0, 0),
(22, 7, ' 男篮热身最后1战遭巴西逆转 ', ' 男篮热身遭巴西逆转 ', '#5674ed', 'upload/2016/08/03/57a19dea6adcb.jpg', ' 男篮 热身 逆转', ' 男篮热身遭巴西逆转 ', '', 0, 1, '3', 'admin', 1470209587, 0, 0),
(23, 7, '美男女篮拒奥运村住豪华渡轮', '美男女篮拒奥运村住豪华渡轮', '#ed568b', 'upload/2016/08/03/57a19e6eb141d.jpg', '美国 男女篮 奥运村 豪华渡轮', '美男女篮拒奥运村住豪华渡轮', '', 0, 1, '3', 'admin', 1470209704, 0, 0),
(24, 13, '林心如办归宁宴 霍建华向亲朋承诺:我会好好爱她', '林心如办归宁宴', '#ed568b', 'upload/2016/08/03/57a19fa767825.jpg', '霍建华 林心如 归宁宴', '林心如办归宁宴 霍建华向亲朋承诺:我会好好爱她', '', 0, 1, '1', 'admin', 1470210019, 0, 0),
(25, 11, '思域的死离不开东风本田的作 销量大幅下滑令人堪忧', '思域销量大幅下滑', '#ed568b', 'upload/2016/08/03/57a1a02d5c97f.jpg', '思域 销量 大幅下滑', '思域销量大幅下滑', '', 0, 1, '1', 'admin', 1470210175, 0, 0),
(26, 8, '上半年7省份居民收入增速跑输GDP，东西收入差距大', '上半年7省份居民收入增速跑输GDP', '#5674ed', 'upload/2016/08/03/57a1a0c991dc3.jpg', '上半年7省份 居民收入 东西收入差距大', '上半年7省份居民收入增速跑输GDP，东西收入差距大', '', 0, 1, '1', 'admin', 1470210515, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_news_content`
--

CREATE TABLE `cms_news_content` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cms_news_content`
--

INSERT INTO `cms_news_content` (`id`, `news_id`, `content`, `create_time`, `update_time`) VALUES
(23, 23, '&lt;p&gt;\r\n	网易体育8月3日报道：\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	巴西里约奥运会的安保问题一直让人担忧，为了保证参加男女篮赛事的这些NBA（WNBA）大牌球星的安全，美篮协可以说是想尽了办法。在男篮比赛的间歇期，男女篮球员们将会住进一个特别的酒店，一艘巨大渡轮上的“螺丝酒店”。这家酒店将为所有的住宿者提供全天候的安全保证，无论是玻璃窗还是墙面都是防弹的。\r\n&lt;/p&gt;', 1470209704, 0),
(27, 27, '玉兔号月球车再次进入休眠状态，她是在2013年12月搭乘嫦娥三号探测器飞往月球的。但跟以前不同的是，这一次超长待机了两年的玉兔号可能再也不会醒来。 一向以卖萌为基调的玉兔号的微博“月球车玉兔”也颇为煽情地说道：\r\n&lt;p&gt;\r\n	Hi！这次是真的晚安咯！！！还有好多问题想知道答案……但我已经是看过最多星星的一只兔子了！如果以后你们去到更深更深的宇宙，一定要记得拍照片，帮我先存着。月球说为我准备了一个长长的梦，不知道梦里我会跃迁去火星，还是会回地球去找师父？\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	玉兔号原本的设计寿命是 3 个月，也就是说它早在 2014 年初就该退役了，但它却在这两年里的数次“休眠”与“被唤醒”中一直正常运转到现在。这只在月球上默默工作的“玉兔”一直保持着在地球的存在感，这要归功于它的官方微博账号“月球车玉兔”。\r\n	&lt;p&gt;\r\n		大家好，我是月面巡视探测器玉兔，你可以叫我@月球车玉兔。我来自中国，4个小时后将和嫦娥三号一起飞向月球。我长得有点普通，但能探测和考察\r\n月球，会收集、分析样品。这是我第一次发微博，希望接下来几个月，能和大家分享太空的样子。其实我有点紧张……希望这次能完成任务。\r\n	&lt;/p&gt;\r\n&lt;/p&gt;', 1470211070, 0),
(22, 22, '&lt;p&gt;\r\n	网易体育8月3日报道：\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	北京时间8月3日早上7点，中国男篮迎来了进驻奥运村前的最后一场热身，在郭艾伦和王哲林没有登场的情况下，球队以69比83的比分不敌巴西。其中易建联表现出色，拿下21分6篮板，翟晓川三\r\n分球5中3，斩获18分。值得一提的是，在上半场比赛，中国男篮一度领先对手达到了两位数，但下半场比赛，还是无力阻止对手的逆转。\r\n&lt;/p&gt;', 1470209587, 0),
(24, 24, '&lt;p&gt;\r\n	新浪娱乐8月2日报道\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	今天，林心如和霍建华在台湾举行归宁宴，当晚亲朋好友到场祝福一对新人。霍建华再度捧起心如脸颊热吻，心如不忘抚摸其嘴唇，并且向亲友承诺：“我会好好爱心如，会好好一起走下去，谢谢大家”说完这段深情的表白后，霍建华脸上洋溢起幸福的笑容，还有些羞涩和不好意思。\r\n&lt;/p&gt;', 1470210019, 0),
(25, 25, '&lt;p&gt;\r\n	&amp;nbsp; 遥想之前全新本田思域上市之时，火爆程度依然记忆犹新。全新1.5T发动机动力强劲，加速成绩煞人，外形个性，空间出色，集合所有的优势于一身，受到了人\r\n们的热切追捧，一度被奉为神车。而现在似乎缓慢的离开了我们的视线，回头我们再看一下当年那个需要加价提车，牛的一塌糊涂的东风本田和全新思域究竟怎么样了？\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 如果没有记错的话，关注度居高不下的新思域在上市之初，就定下了年销量10万的宏大计划。然而，从今年4月至今，新思域连续两月销量分别为5822辆、6578辆，离预期的“月销破万”相去甚远，东风本田要想实现当初的“豪言”，似乎有些困难。\r\n	&lt;p&gt;\r\n		&amp;nbsp; 很多人都已经猜到东风本田这种加价是一种作死的行为，可是还是有很多群众满腹情怀的手捧人民币，前赴后继冲进东风本田的4S店，豪气且大方地购\r\n买着一辆辆加价的新思域时，东风本田面对消费者的“热情”坦然地照单全收。加价营销在能为产品带来足够的关注度和话题性的同时，对消费者和厂家而言，也是\r\n一种互相伤害的行为。不少奔着新思域强大产品力的消费者在听闻加价之后，表示难以接受，更有甚者直接放弃转投其它车型。这对有宏大销量计划的新思域乃至东\r\n本来说并不是一个好消息，就更别提失去的口碑与人心了。\r\n	&lt;/p&gt;\r\n&amp;nbsp; 除了大家诟病的加价问题，新思域在上市之初还饱受“断轴”困扰，引发不少消费者对其产品质量的担忧。由于我们没有亲眼见到事故发生的经过，所以无法\r\n妄下结论。从已知的现场图片看，轮毂和轮胎的损毁程度并不大，且护栏并未倒下，可以推测当时的车速并不快。虽然新思域和上一代车型均采用麦弗逊独立悬挂，\r\n但新思域的前悬挂下摆臂进行了全新的设计，为钢制材质，前防倾杆造型发生了改变。按事故现场情况分析，思域的断轴略显诡异，此外多个互联网论坛也曝出新思\r\n域断轴案例。\r\n	&lt;p&gt;\r\n		&amp;nbsp; 全新思域的动力和造型确实不错，不过也有一定缺点，如噪音大，用料做工还有待提升等。质疑和口碑齐飞，无奈新思域的上升势头并不如想象中的那么迅猛。\r\n	&lt;/p&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;', 1470210175, 0),
(26, 26, '&amp;nbsp; 国家统计局数据显示，上半年全国居民人均可支配收入11886元，同比名义增长8.7%。扣除价格因素，实际增长了6.5%，接近上半年6.7%的经济增速。\r\n&lt;p&gt;\r\n	具体到地方，则表现不一。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 此前，各地公布的GDP增速为剔除物价的增速，而居民收入增速往往未剔除物价，这样比较的结果是，只有很少的省市自治区居民收入增速跑赢了GDP。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;7地居民收入增速未跑赢GDP&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 21世纪经济报道汇总各地数据发现，上半年大多数省份居民收入增速跑赢了GDP增速。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	例如，以名义增速计算，山西上半年GDP增速是-1.7%，而城乡居民收入增速则很快，其城乡人均可支配收入分别为6%、6.5%；内蒙古、吉\r\n林上半年名义GDP增速分别为2%、4%左右，而内蒙古城乡人均可支配收入增速分别为8%、8%，吉林则分别为6.8%、5.3%，均高于GDP名义增\r\n速。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 中国社科院数量所研究员沈利生表示，整体而言，大部分地区的居民收入是跑赢GDP的，这是因为整体经济相对稳定，尤其服务业越发达地区，居民收入水平越高。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 21世纪经济报道获悉，贵州、海南、重庆等7地之所以城乡居民收入增速未全部跑赢GDP，是因为名义GDP增速太高。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 北京师范大学经济管理学院教授李实认为，总体而言，一地居民收入高低，大体上与人均GDP正相关，经济发展仍是&amp;nbsp; 提升居民收入的必要条件，同时，居民收入慢的地区，经济增速更慢。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	中国财经政法大学财税学院院长陈志勇进一步解释，有些经济增速低的地区而居民收入增速较高，有劳动力跨区域流动、政府补贴和转移支付以及跨区之间的再分配，导致区域的再均衡。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;strong&gt;东西居民收入差距大&lt;/strong&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 从统计数据看，东西部居民收入差距较大。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 今年上半年，在31个省市自治区，西藏城镇和农村居民人均可支配收入增速最高，分别为10.4%、11.7%，分别为13899元、3151\r\n元。但与东部的上海相比差距很大——上海城乡居民人均可支配收入分别为29030元、14638元，分别是西藏2倍和4.64倍。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 此外，上半年上海农村居民人均可支配收入额，是新疆农村居民人均可支配收入1502.12元的10倍。新疆上半年城镇人均可支配收入为13868.50元，也只有上海的1/2。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&amp;nbsp; 另上半年甘肃城镇居民人均可支配收入12162.4元，为全国最低。\r\n&lt;/p&gt;', 1470210515, 0);

-- --------------------------------------------------------

--
-- 表的结构 `cms_position`
--

CREATE TABLE `cms_position` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cms_position_content`
--

CREATE TABLE `cms_position_content` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `position_id` int(5) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) UNSIGNED NOT NULL,
  `listorder` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- 转存表中的数据 `cms_position_content`
--

INSERT INTO `cms_position_content` (`id`, `position_id`, `title`, `thumb`, `url`, `news_id`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(18, 2, '美男女篮拒奥运村住豪华渡轮', 'upload/2016/08/03/57a19e6eb141d.jpg', NULL, 23, 2, 1, 1470209704, 0),
(16, 3, '上半年7省份居民收入增速跑输GDP，东西收入差距大', 'upload/2016/08/03/57a1a0c991dc3.jpg', NULL, 26, 0, 1, 1470210515, 0),
(15, 2, ' 男篮热身最后1战遭巴西逆转 ', 'upload/2016/08/03/57a19dea6adcb.jpg', NULL, 22, 3, 1, 1470209587, 0),
(17, 3, '萌萌的玉兔号月球车跟人类说了再见：她再也不会醒来了', 'upload/2016/08/03/57a1a3d539ef5.jpg', NULL, 27, 0, 1, 1470211070, 0),
(19, 2, '林心如办归宁宴 霍建华向亲朋承诺:我会好好爱她', 'upload/2016/08/03/57a19fa767825.jpg', NULL, 24, 1, 1, 1470210019, 0),
(20, 3, '思域的死离不开东风本田的作 销量大幅下滑令人堪忧', 'upload/2016/08/03/57a1a02d5c97f.jpg', NULL, 25, 0, 1, 1470210175, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admin`
--
ALTER TABLE `cms_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `cms_menu`
--
ALTER TABLE `cms_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `listorder` (`listorder`),
  ADD KEY `parentid` (`parentid`),
  ADD KEY `module` (`m`,`c`,`f`);

--
-- Indexes for table `cms_news`
--
ALTER TABLE `cms_news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `status` (`status`,`listorder`,`news_id`),
  ADD KEY `listorder` (`catid`,`status`,`listorder`,`news_id`),
  ADD KEY `catid` (`catid`,`status`,`news_id`);

--
-- Indexes for table `cms_news_content`
--
ALTER TABLE `cms_news_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `cms_position`
--
ALTER TABLE `cms_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_position_content`
--
ALTER TABLE `cms_position_content`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cms_admin`
--
ALTER TABLE `cms_admin`
  MODIFY `admin_id` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `cms_menu`
--
ALTER TABLE `cms_menu`
  MODIFY `menu_id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `cms_news`
--
ALTER TABLE `cms_news`
  MODIFY `news_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `cms_news_content`
--
ALTER TABLE `cms_news_content`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `cms_position`
--
ALTER TABLE `cms_position`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `cms_position_content`
--
ALTER TABLE `cms_position_content`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
