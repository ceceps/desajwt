/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : db_desawisataj

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 04/03/2019 16:40:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for r_media_video
-- ----------------------------
DROP TABLE IF EXISTS `r_media_video`;
CREATE TABLE `r_media_video`  (
  `id` bigint(28) NOT NULL AUTO_INCREMENT,
  `code_id` bigint(20) NOT NULL,
  `parent_table` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mimetype` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `extensi` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `filename` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `filesize` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `narasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `author_id` int(11) NULL DEFAULT NULL,
  `parent_media` int(1) NULL DEFAULT 0 COMMENT 'Induk utama ',
  `status` int(1) NULL DEFAULT NULL COMMENT '0=hide, 1=tampil',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `code_id`) USING BTREE,
  INDEX `media_id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_media_video
-- ----------------------------
INSERT INTO `r_media_video` VALUES (1, 1, 'r_desawisata', 'video/mp4', 'mp4', 'Video-Desa-Cibuntu.mp4', '24 MB', 'Keindahan Potensi Wisata Desa Wisata Cibuntu', 'Berwisata ke Kabupaten Kuningan tidak lengkapnya rasanya jika tidak mengunjungi desa wisata Cibuntu. Sebuah desa wisata yang termasuk unik, karena di lingkungan desa banyak ditemuka situs-situ purbakala. Desa ini masuk ke Kecamatan Pasawahan, Kabupaten Kuningan dan berbatasan langsung dengan Kabupaten Cirebon. Konon desa tersebut sudah ada sejak jaman batu (Megalitikum). Ini terlihat jejaknya masih ada berupa kuburan batu yang masuk dalam situs purbakala di Kabupaten Kuningan.\r\nBerada di ujung Barat Kabupaten Kuningan, desa ini persis berada di lereng gunung Ciremai. Sehingga tak mengherankan, jika udara di desa ini sangat sejuk dan menyegarkan. Tanaman hijau menjadi pemandangan khas di kawasan desa wisata ini. Belum lagi keramahan warga desa yang menyapa setiap tamu yang ada ke desa meraka, membuat Anda akan semakin merasa betah berlama-lama di desa ini. Desa wisata di bawah kaki gunung Ceremai terlihat sangat hijau dipenuhi tanaman padi yang tengah menghijau dan tanaman hutan yang masih terjaga kelestariannya.\r\nSaat memasuki gerbang Desa Cibuntu, Anda akan disambut ki lengser yang disiapkan untuk menyambut tamu layaknya menyambut rombongan pengantin pria yang akan mememinang pengantin perempuan. Diiringi gamelan dan musik angklung, ki lengser menari dengan lincah diikuti dua orang pembawa payung. Mereka akan membawa Anda dan rombongan ke tanah lapangan yang dipasangi tenda dan disiapkan minuman khas Desa Cibuntu, yakni jasreh (jahe sareng sereh). Minuman ini adalah minuman welcome dinner yang sengaja disuguhkan warga desa kepada para pengunjung.\r\nKe unikkan lainnya, di desa Cibuntu terdapat situs-situs purbakala yang konon ceritanya merupakan tempat-tempat napak tilas para wali ketika akan menuju ke Gunung Ciremai. Benar atau tidak cerita itu, hanya warga desa yang tahu. Pasalnya, situ-situs yang ada di desa tersebut kebanyakan situs kuburan batu pada jaman megalitikum. Dari dalam kuburan batu itu banyak ditemukan kapak genggam yang terbuat dari batu. Kini kapak batu tersebut disimpan di Museum Cipari.\r\nSitus-situ purbakala tersebut, banyak ditemukan di pekarangan rumah penduduk. Namun ada pula yang jauh dari pemukiman warga. Keberadaan situs-situs tersebut tidak mengganggu aktivitas penduduk setempat. Justru sebaliknya, situs-situs tersebut dipelihara dengan baik, bahkan ada beberapa diantara warga yang menjadi juru perlihara. Situs-situs tersebut antara lain Ada Situs Bujal Dayeuh, Hulu dayeuh, Sahurip kaler, Sahurip kidul, cikahuripan dan Curug Bongsreng.\r\nSitus tersebut berkaitan dengan asal mula dari desa Cibuntu dan mata air yang masih terjaga di desa tersebut. Menurut kepala desa Cibuntu, Awam, keberadaan situs itu memang dijaga warga, karena banyak memberikan kehidupan bagi masyarakat.\r\n\"Selain memberikan manfaat bagi masyarakat, situ-situs tersebut menjadikan desa ini ditunjuk jadi desa wisata oleh Pemkab Kuningan,\" tabdasnya.\r\nSementara aktivitas yang bisa dilakukan para pengunjung desa wisata Cibuntu, antara lain sepeda gunung, agrowisata, wisata bejarah dan pengunjung dapat menginap di home stay serta dapat menikmati berbagai macam kuliner khas desa Cibuntu. Berkeliling Desa Wisata Cibuntu Kecamatan Pasawahan Kabupaten Kuningan cukup menguras tenaga. Namun rasa lelah dan capek mendadak sirna begitu tenggorokan tersentuh air cikahuripan.\r\nAirnya berwarna bening, dingin dan segar. Tak mengherankan hampir seluruh pengunjung yang datang ke desa Cibuntu ingin merasakan dinginnya air cikahuripan yang menyegarkan. \"Lumayan segar dan dingin airnya, bening lagi,\" kata Ohim salah pengunjung desa wisata Cibuntu. Menurut Ohim, dirinya tidak hanya sekedar membasuh muka, tapi meminum langsung air cikahuripan tersebut. Ohim mengatakan, airnya keluar dari mata air, sehingga bisa langsung diminum.\r\nSelain air Cikahuripan, di desa itu terdapat sebuah air terjun dengan ketinggian lebih dari 25 meter. Air terjun ini dinamakan Curug Bongsreng terletak agak jauh dari pemukiman warga. Berada ditebing batu, menjadikan air terjun ini sangat menantang untuk didatangi. Untuk bisa mencapai kesana, Anda harus berjalab kaki kurang lebih 2 km melalui jalan setapak dan titian tangga. Sebelumnya Anda akan menyusuri hutan dan perkebunan milik warga.\r\nRasa lelah dan capek, seketika itu pula sirna begitu Anda tiba di Curug Bongsreng. Airnya yang bening dan menyegarkan mengundang Anda untuk segera mandi maupun membasuh muka. Apalagi tepian air terjun sudah dibangun tempat duduk dari semen yang melingkat mengitari air terjun. Belum lagi di kanan air terjun terdapat sebuah dangau yang dinaungi pohon besar.\r\nAir terjun bukan objek yang terakhir. Sebelumnya, tepat di kaki Gunung Ceremai terdapat sebuah situs yang disebut situs Bujal Dayeuh dan Hulu Dayeuh. Dari situs ini, sebenarnya Anda bisa menaikki langsung gunung Ceremai. Menurut warga setempat, jalan setapak di situs Bujal Dayeuh ini merupakan jalan terdekat ke puncak Ceremai.\r\nNamun sayang, keberadaan desa wisata ini tidak dibarengi dengan bangunan khas masyarakat desa. Hampir 90 persen bangunan rumah di desa tersebut terbuat dari semen (di cor), sehingga menghilangkan kesan suasana perdesaan. Walaupun kehidupan masyarakatnya masih mempertahankan masyarakat desa, tapi kurang begitu menyengat. Begitu pun jalanan desa yang sudah dihotmix serta saluran air yang dibenton serta listrik sudah menyala disana-sini.\r\nDesa Cibuntu dipimpin oleh seorang kepala desa yakni, H.Awam Hamara dan sekertarisnya Iwan Jamsuki. Ada beberapa hal yang perlu diketahui tentang Desa Cibuntu yang berkaitan dengan pariwisata, seni dan budaya.\r\nUntuk Pariwisata, di desa Cibuntu terdapat situs-situs yang konon ceritannya merupakan tempat-tempat napak tilas para wali ketika akan menuju ke Gunung ciremai. Salah satu yang agak unik namanya situs Loa. Situs yang tersusun rapih ada satu batu besar mirip sebuah meja kemudian dikelilingi batu-batu kecil mirip sebuah kursi, disampingnya ada aliran air dan dibawah pohon loa yang meneduhi meja tersebut keberadaanya percis sebelum masuk desa Cibuntu.\r\nJaman Batu\r\nUntuk seni, masyarakat desa Cibuntu pada dasarnya banyak yang berjiwa seni misalkan ada seorang tokoh tua yang namanya Mang Pandi beliu termasuk orang yang merintis adanya group sandiwara dan reog. Untuk budaya, desa Cibuntu merupakan sebuah desa yang penghuninya diperkirakan sudah ada sejak jaman batu. Perkiraan itu bukan tanpa dasar karena di desa cibuntu pernah ditemukan benda-benda purbakala berupa alat yang dibuat dari batu, Giok dan lain-lain. Penemunya Mang Jai dan tempat penemuannya percis dibelakang kantor desa Cibuntu. Sayang, benda-benda yang tak ternilai hargannya itu raib entah kemana rimbanya. Ada satu hal yang sampai saat ini budaya masih dipertahankan yaitu dengan sikap kegotong royongannya dalam melakukan kegiatan-kegiatan, seperti pembangunan rumah, saling membantu biaya rumah sakit, biaya persalinan, dan lain-lain.\r\nUntuk menuju ke desa Cibuntu kalau rute dari Cirebon tahapannya adalah : Cirebon – Sumber (Plangon) – Mandirancan – Paniis- Cibuntu dengan jarak tempuh ± 30 km. Bisa menggunakan kendaraan pribadi maupun carteran ataupun angkutan umum. Jalannya lumayan berliku, namun kiri kanan dipenuhi tumbuhan hutan dan perkebunan warga.\r\n\r\n', NULL, 1, 1, 1, '2018-10-24 06:44:19', NULL);
INSERT INTO `r_media_video` VALUES (2, 41, 'r_desawisata', NULL, 'mp4', 'Liputan Desa Wisata SAKERTA TIMUR Kuningan Jabar.mp4', NULL, 'Video Profil Sakerta Timur', NULL, NULL, NULL, 0, NULL, '2019-03-04 14:04:59', '2019-03-04 14:04:59');

SET FOREIGN_KEY_CHECKS = 1;
