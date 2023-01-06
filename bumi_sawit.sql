/*
Navicat MySQL Data Transfer

Source Server         : web
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bumi_sawit

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-01-07 05:17:36
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('50', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `migrations` VALUES ('51', '2022_12_26_104935_create_users_table', '1');
INSERT INTO `migrations` VALUES ('52', '2022_12_29_115521_create_produk_kategori_table', '1');
INSERT INTO `migrations` VALUES ('53', '2022_12_29_115538_create_produk_table', '1');
INSERT INTO `migrations` VALUES ('54', '2023_01_06_184807_create_pesanan_table', '2');
INSERT INTO `migrations` VALUES ('55', '2023_01_06_185032_create_pesanan_detail_table', '2');

-- ----------------------------
-- Table structure for `personal_access_tokens`
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for `pesanan`
-- ----------------------------
DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE `pesanan` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pesanan_id_user_foreign` (`id_user`),
  CONSTRAINT `pesanan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pesanan
-- ----------------------------
INSERT INTO `pesanan` VALUES ('3', '1', 'Menunggu Konfirmasi', '2023-01-07 03:49:34', '2518992', '2023-01-06 19:36:20', '2023-01-06 19:36:20');
INSERT INTO `pesanan` VALUES ('4', '1', 'Selesai', '2023-01-07 03:50:24', '3258000', '2023-01-06 20:02:40', '2023-01-06 20:50:24');

-- ----------------------------
-- Table structure for `pesanan_detail`
-- ----------------------------
DROP TABLE IF EXISTS `pesanan_detail`;
CREATE TABLE `pesanan_detail` (
  `id_pesan` bigint(20) unsigned NOT NULL,
  `id_produk` bigint(20) unsigned NOT NULL,
  `harga` double NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double NOT NULL,
  KEY `pesanan_detail_id_pesan_foreign` (`id_pesan`),
  KEY `pesanan_detail_id_produk_foreign` (`id_produk`),
  CONSTRAINT `pesanan_detail_id_pesan_foreign` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pesanan_detail_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pesanan_detail
-- ----------------------------
INSERT INTO `pesanan_detail` VALUES ('3', '22', '290000', '2', '580000');
INSERT INTO `pesanan_detail` VALUES ('3', '26', '484748', '4', '1938992');
INSERT INTO `pesanan_detail` VALUES ('4', '3', '635000', '4', '2540000');
INSERT INTO `pesanan_detail` VALUES ('4', '2', '359000', '2', '718000');

-- ----------------------------
-- Table structure for `produk`
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori` bigint(20) unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` double NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `spesifikasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` int(11) NOT NULL,
  `jenis` enum('top-sales','favorit','unggulan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `produk_nama_unique` (`nama`),
  KEY `produk_id_user_foreign` (`id_user`),
  KEY `produk_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `produk_kategori` (`id`) ON DELETE CASCADE,
  CONSTRAINT `produk_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES ('1', '1', 'Bibit Sawit SOCFINDO Medan Super Unggul', 'bibit-sawit-socfindo-medan-super-unggul', '200', '1064000', '<div>Warna : Hitam</div><div>Ukuran : S</div><div>234267655/20002653451</div><div><br></div><div>- DxP SOCFINDO</div>', '<div>Asal : Dura x pisifera</div><div>Pertumbuhan : 55 - 65 cm/thn</div><div>Lingkar Batang : 3 - 3,5 meter</div><div>Panjang pelepah : 6.50 meter</div><div>Produksi pelepah : 13-17 pelepah/thn</div><div>Usia mulai berbuah : 23 bulan</div><div>Usia mulai panen : 32 bulan</div><div>Jumlah tandan : 12 - 18 tandan/thn</div><div>Berat tandan : 15 - 30 kg/tandan</div>', '0', null, '167257983565.png', '2', '2023-01-01 13:30:35', '2023-01-01 13:30:35');
INSERT INTO `produk` VALUES ('2', '1', 'Benih Bibit Kecambah Kelapa Sawit SOCFINDO Super Unggul', 'benih-bibit-kecambah-kelapa-sawit-socfindo-super-unggul', '200', '359000', '<div>Warna : Merah</div><div>Ukuran : XL</div><div>234267655/20002653451</div>', '<div>Asal : Dura x pisifera</div><div>Pertumbuhan : 55 - 65 cm/thn</div><div>Lingkar Batang : 3 - 3,5 meter</div><div>Panjang pelepah : 6.50 meter</div><div>Produksi pelepah : 13-17 pelepah/thn</div><div>Usia mulai berbuah : 23 bulan</div><div>Usia mulai panen : 32 bulan</div><div>Jumlah tandan : 12 - 18 tandan/thn</div><div>Berat tandan : 15 - 30 kg/tandan</div>', '0', 'favorit', '167256889622.png', '2', '2023-01-01 12:41:57', '2023-01-01 12:41:57');
INSERT INTO `produk` VALUES ('3', '1', 'Bibit Pohon Kecambah Kelapa Sawit DXP PPKS 239 Medan Unggul', 'bibit-pohon-kecambah-kelapa-sawit-dxp-ppks-239-medan-unggul', '301', '635000', '<div>Warna : Merah</div><div>Ukuran : XL</div><div>234267655/20002653451</div>', '<div>Asal : Dura x pisifera</div><div>Pertumbuhan : 55 - 65 cm/thn</div><div>Lingkar Batang : 3 - 3,5 meter</div><div>Panjang pelepah : 6.50 meter</div><div>Produksi pelepah : 13-17 pelepah/thn</div><div>Usia mulai berbuah : 23 bulan</div><div>Usia mulai panen : 32 bulan</div><div>Jumlah tandan : 12 - 18 tandan/thn</div><div>Berat tandan : 15 - 30 kg/tandan</div>', '15', 'unggulan', '16725690432.png', '2', '2023-01-06 21:17:28', '2023-01-06 21:17:28');
INSERT INTO `produk` VALUES ('5', '2', 'Egrek/Dodos Sawit Mi', 'egrekdodos-sawit-mi', '900', '279000', '<div>EGREK MI GLOBAL ORIGINAL</div><div>- EGREK MI GLOBAL BIRU</div><div><br></div><div>JAMINAN 100% ORIGINAL</div><div>Kualitas A1</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258019287.png', '2', '2023-01-06 21:17:16', '2023-01-06 21:17:16');
INSERT INTO `produk` VALUES ('6', '2', 'Dodos Sawit Mi Global Original Made  In Malaysia - MI 4 IN', 'dodos-sawit-mi-global-original-made-in-malaysia-mi-4-in', '200', '279000', '<div>KUALITAS A1</div><div>KETAHANAN TERJAMIN</div><div>TIDAK MUDAH PATAH</div><div>BAHAN LEBIH TEBAL</div><div>KUALITAS TERJAMIN</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258023184.png', '2', '2023-01-01 13:37:11', '2023-01-01 13:37:11');
INSERT INTO `produk` VALUES ('7', '2', 'Cangkul Pencabut Rumput Gardening  Tools PG KDR', 'cangkul-pencabut-rumput-gardening-tools-pg-kdr', '390', '20000', '<div>Fitur:</div><div>1. Varian alat berkebun:sekop, garu, pencabut rumput, cangkul koret dan cangkul garu, Anda dapat memilih apa yang Anda butuhkan.</div><div>2. Sangat cocok untuk menggali, menyiangi, melonggarkan tanah, memindahkan, merapikan tanah</div><div>3. Alat berkebun ini sempurna untuk penggemar berkebun.</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258027155.png', '2', '2023-01-01 13:37:51', '2023-01-01 13:37:51');
INSERT INTO `produk` VALUES ('8', '2', 'Sekop Pencabut Rumput Gardening  Tools PG KDR', 'sekop-pencabut-rumput-gardening-tools-pg-kdr', '150', '20000', '<div>Fitur:</div><div>1. Varian alat berkebun:sekop, garu, pencabut rumput, cangkul koret dan cangkul garu, Anda dapat memilih apa yang Anda butuhkan.</div><div>2. Sangat cocok untuk menggali, menyiangi, melonggarkan tanah, memindahkan, merapikan tanah</div><div>3. Alat berkebun ini sempurna untuk penggemar berkebun.</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258514722.png', '2', '2023-01-01 14:59:07', '2023-01-01 14:59:07');
INSERT INTO `produk` VALUES ('9', '2', 'Cakar Pencabut Rumput Gardening  Tools PG KDR', 'cakar-pencabut-rumput-gardening-tools-pg-kdr', '700', '30000', '<div>Fitur:</div><div>1. Varian alat berkebun:sekop, garu, pencabut rumput, cangkul koret dan cangkul garu, Anda dapat memilih apa yang Anda butuhkan.</div><div>2. Sangat cocok untuk menggali, menyiangi, melonggarkan tanah, memindahkan, merapikan tanah</div><div>3. Alat berkebun ini sempurna untuk penggemar berkebun.</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258520099.png', '2', '2023-01-01 15:00:00', '2023-01-01 15:00:00');
INSERT INTO `produk` VALUES ('10', '2', 'Garpu Pencabut Rumput Gardening  Tools PG KDR', 'garpu-pencabut-rumput-gardening-tools-pg-kdr', '760', '20000', '<div>Fitur:</div><div>1. Varian alat berkebun:sekop, garu, pencabut rumput, cangkul koret dan cangkul garu, Anda dapat memilih apa yang Anda butuhkan.</div><div>2. Sangat cocok untuk menggali, menyiangi, melonggarkan tanah, memindahkan, merapikan tanah</div><div>3. Alat berkebun ini sempurna untuk penggemar berkebun.</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258543235.png', '2', '2023-01-01 15:03:52', '2023-01-01 15:03:52');
INSERT INTO `produk` VALUES ('11', '2', 'Mesin Panen Kelapa Sawit Alat Panen  Sawit Dodos Sawit Egrek', 'mesin-panen-kelapa-sawit-alat-panen-sawit-dodos-sawit-egrek', '200', '4500000', '<div>Fitur:</div><div>1. Varian alat berkebun:sekop, garu, pencabut rumput, cangkul koret dan cangkul garu, Anda dapat memilih apa yang Anda butuhkan.</div><div>2. Sangat cocok untuk menggali, menyiangi, melonggarkan tanah, memindahkan, merapikan tanah</div><div>3. Alat berkebun ini sempurna untuk penggemar berkebun.</div>', '<div>✓ KETAJAMAN TANPA DI ASAH LANGSUNG DI PAKAI</div><div>✓ IMPOR MALAYSIA ORIGINAL</div><div>✓ BUATAN MESIN</div><div>✓ DI JAMIN TIDAK BAKAL KECEWA DENGAN KUALITAS PRODUK</div><div>✓ DI BUAT DENGAN BESI PILIHAN</div><div><br></div><div>Siap kirim seluruh Indonesia</div>', '0', null, '167258634476.png', '2', '2023-01-01 15:19:04', '2023-01-01 15:19:04');
INSERT INTO `produk` VALUES ('12', '3', 'Minyak Goreng Multimas Kelapa Sawit 900ML', 'minyak-goreng-multimas-kelapa-sawit-900ml', '200', '21500', '<div>Warna : Hitam</div><div>Ukuran : S</div><div>234267655/20002653451</div><div><br></div><div>- DxP SOCFINDO</div>', '<div>Menyempurnakan Masakan, Pilihan Para Koki</div><div>Minyak Goreng Nabati yang terbuat dari minyak kelapa berkualitas dengan kandungan Vitamin E, Omega 6 dan Omega 9.</div><div>Multifungsi masakan baik untuk menumis maupun menggoreng dengan multi manfaat.</div><div><br></div><div>GROSIR</div><div>1 DOS 900ml - isi 12pcs (wajib order kelipatan 12)</div><div><br></div><div>*CHAT ADMIN untuk order grosi</div><div><br></div><div>100% Minyak Sawit Asli</div>', '0', null, '167258666574.png', '2', '2023-01-01 15:24:25', '2023-01-01 15:24:25');
INSERT INTO `produk` VALUES ('13', '3', 'Minyak Goreng Multimas Kelapa Sawit 1.8L', 'minyak-goreng-multimas-kelapa-sawit-18l', '200', '50500', '<div>Warna : Hitam</div><div>Ukuran : S</div><div>234267655/20002653451</div><div><br></div><div>- DxP SOCFINDO</div>', '<div>Menyempurnakan Masakan, Pilihan Para Koki</div><div>Minyak Goreng Nabati yang terbuat dari minyak kelapa berkualitas dengan kandungan Vitamin E, Omega 6 dan Omega 9.</div><div>Multifungsi masakan baik untuk menumis maupun menggoreng dengan multi manfaat.</div><div><br></div><div>GROSIR</div><div>1 DOS 900ml - isi 12pcs (wajib order kelipatan 12)</div><div><br></div><div>*CHAT ADMIN untuk order grosi</div><div><br></div><div>100% Minyak Sawit Asli</div>', '0', null, '167258680639.png', '2', '2023-01-01 15:26:46', '2023-01-01 15:26:46');
INSERT INTO `produk` VALUES ('14', '3', 'Mentega Putih Organik, Asli, Minyak Kelapa Sawit Merah dan Minyak Kelapa 425 G', 'mentega-putih-organik-asli-minyak-kelapa-sawit-merah-dan-minyak-kelapa-425-g', '200', '50500', '<div>Warna : Hitam</div><div>Ukuran : S</div><div>234267655/20002653451</div><div><br></div><div>- DxP SOCFINDO</div>', '<div>Menyempurnakan Masakan, Pilihan Para Koki</div><div>Minyak Goreng Nabati yang terbuat dari minyak kelapa berkualitas dengan kandungan Vitamin E, Omega 6 dan Omega 9.</div><div>Multifungsi masakan baik untuk menumis maupun menggoreng dengan multi manfaat.</div><div><br></div><div>GROSIR</div><div>1 DOS 900ml - isi 12pcs (wajib order kelipatan 12)</div><div><br></div><div>*CHAT ADMIN untuk order grosi</div><div><br></div><div>100% Minyak Sawit Asli</div>', '0', null, '167258749469.png', '2', '2023-01-01 15:38:14', '2023-01-01 15:38:14');
INSERT INTO `produk` VALUES ('15', '4', 'Sabun Herbal Handmade Kulit Normal', 'sabun-herbal-handmade-kulit-normal', '200', '42500', '<div>- Semua sabun bisa untuk tubuh dan wajah</div><div>- Aman untuk bumil, busui, anak2, penderita eczema, psoriasis maupun yang berkulit sensitive</div>', 'Mengandung minyak sawit, madu, dan oatmeal. Bermanfaat untuk kulit kering, eczema dan psoriasis', '0', null, '167258813949.png', '2', '2023-01-01 15:48:59', '2023-01-01 15:48:59');
INSERT INTO `produk` VALUES ('16', '4', 'Sabun Herbal Handmade Kulit Kering', 'sabun-herbal-handmade-kulit-kering', '200', '42500', '<div>- Semua sabun bisa untuk tubuh dan wajah</div><div>- Aman untuk bumil, busui, anak2, penderita eczema, psoriasis maupun yang berkulit sensitive</div>', 'Mengandung minyak sawit, madu, dan oatmeal. Bermanfaat untuk kulit kering, eczema dan psoriasis', '0', null, '167258822545.png', '2', '2023-01-01 15:50:25', '2023-01-01 15:50:25');
INSERT INTO `produk` VALUES ('17', '5', 'Probiotik Pupuk Organik Cair Kelapa  Sawit', 'probiotik-pupuk-organik-cair-kelapa-sawit', '200', '120000', '<div>Probiotik BlueGreen Biotech Kelapa Sawit Pupuk Organik Cair</div><div>Mempercepat pertumbuhan kelapa sawit</div><div>Meningkatkan hasil panen kelapa sawit</div><div>– bobot / berat panen lebih tinggi</div><div>– waktu panen lebih awal, masa panen puncak lebih lama</div><div>– usia produksi lebih lama</div><div>Meningkatkan kualitas hasil panen.</div><div>Meningkatkan daya tahan tanaman terhadap penyakit.</div><div>Memperbaiki tanah yang rusak / mengembalikan kesuburan tanah</div><div>Mengurangi penggunaan pupuk kimia.</div><div>Memacu perkembangan microorganisme tanah yang berguna bagi tanaman.</div><div><br></div><div>Dapat digunakan di berbagai kondisi lahan (dataran rendah – dataran tinggi, lahan basah – lahan kering, lahan normal – lahan kritis) di berbagai wilayah (berbagai jenis tanah) di Indonesia.</div><div><br></div><div>Dapat digunakan pada semua jenis tanaman budidaya (tanaman pangan, hortikultura, perkebunan, kehutanan), termasuk kelapa sawit.&nbsp;</div>', '<div>PEMBIBITAN</div><div>Penyemprotan bibit : 3 tutup botol POC BlueGreen Biotech / tangki / 2 minggu, atau</div><div>Penyiraman : 3 tutup POC BlueGreen Biotech / 10 liter air, kemudian disiramkan 1 gelas Aqua untuk setiap polibag 2 minggu sekali.</div><div><br></div><div>TANAMAN BELUM MENGHASILKAN (TBM)</div><div>Umur 0-1 tahun</div><div>Semprot 3-5 tutup POC BlueGreen Biotech /tangki / 1-2 bulan sekali.</div><div>Umur 1-2 tahun</div><div>Semprot 3-5 tutup POC BlueGreen Biotech /tangki 1-2 bulan sekali.</div><div>Umur 2-3 tahun</div><div>Semprot 3-5 tutup POC BlueGreen Biotech /tangki 1-2 bulan sekali.</div><div><br></div><div>TANAMAN MENGHASILKAN (TM)</div><div>Semprot 3-5 tutup POC BlueGreen Biotech /tangki 1-2 bulan sekali.</div><div><br></div>', '0', null, '167258831243.png', '2', '2023-01-01 15:51:52', '2023-01-01 15:51:52');
INSERT INTO `produk` VALUES ('18', '5', 'Novelgro Injection No.3 Pupuk Injeksi  Batang Kelapa Sawit', 'novelgro-injection-no3-pupuk-injeksi-batang-kelapa-sawit', '200', '417000', '<div>Pupuk Injeksi Batang dirancang khusus untuk tanaman kelapa sawit dengan target penghematan biaya. Hal tersebut dicapai dengan pemupukan langsung melalui batangnya, sehingga pupuk terserap 100% ke dalam jaringan tanaman.</div><div>Cara ini juga menjamin terpenuhinya kebutuhan hara pada musim kering dan cocok untuk lahan gambut.</div>', '<div>100 % terserap tanaman</div><div>Tidak merusak tanaman</div><div>Tidak merusak tanah</div><div>Ramah lingkungan</div><div>Dapat diaplikasikan pada musim apapun</div><div>Meningkatkan hasil panen sampai dengan 5-20%</div><div>Hemat biaya angkut, langsir dan gudang pupuk.</div><div>Kadar Betakaroten meningkat</div><div>Rendemen minyak sawit meningkat</div><div>Rata-rata berat tandan meningkat</div><div>Hanya menggunakan 12 kg/ha/tahun</div>', '0', null, '167258835179.png', '2', '2023-01-01 15:52:31', '2023-01-01 15:52:31');
INSERT INTO `produk` VALUES ('19', '5', 'Pupuk Majemuk Spesialisasi Kelapa Sawit NPK Kujang 30-6-8 Non-Subsidi', 'pupuk-majemuk-spesialisasi-kelapa-sawit-npk-kujang-30-6-8-non-subsidi', '200', '417000', '<ul><li>Mencegah kehilangan unsur hara</li><li>Mempengaruhi sifat fisik tanah enjadi lebih gembur</li><li>Meningkatkan daya serap unsur hara oleh tanaman</li><li>Meningkatkan daya serap tanah terhadap air, sehingga menjaga ketersediaan air dalam tanah</li><li>Meningkatkan perkembangan ikroorganisme tanah</li><li>Meningkatkan perkembangan mikroorganisme makro (N, P, K) dan mikro seimbang dan sesuai dengan kebutuhan tanaman</li></ul>', 'NPK Kujang 30-6-8 plus organik adalah pupuk majemuk dengan kandungan N, P, dan K seimbang sesuai dengan kebutuhan tanaman.', '0', null, '167258841911.png', '2', '2023-01-01 15:53:39', '2023-01-01 15:53:39');
INSERT INTO `produk` VALUES ('20', '5', 'Auksin Hormon Tanaman', 'auksin-hormon-tanaman', '200', '417000', 'Fungsi Auksin &gt;&gt; untuk merangsang pertumbuhan akar pada tanaman', '<ul><li>Konsentrat bahan aktif 500 ppm</li><li>isi 60 ml</li></ul>', '0', null, '167258846030.png', '2', '2023-01-01 15:54:20', '2023-01-01 15:54:20');
INSERT INTO `produk` VALUES ('21', '5', 'Pupuk Granul Organik 1Kg - Pupuk  Kelapa Sawit dan Karet Berkualitas', 'pupuk-granul-organik-1kg-pupuk-kelapa-sawit-dan-karet-berkualitas', '200', '417000', 'Fungsi Auksin &gt;&gt; untuk merangsang pertumbuhan akar pada tanaman', '<ul><li>Konsentrat bahan aktif 500 ppm</li><li>isi 60 ml</li></ul>', '0', null, '167258849973.png', '2', '2023-01-01 15:54:59', '2023-01-01 15:54:59');
INSERT INTO `produk` VALUES ('22', '6', 'Latrex 400 EC 1 L Obat Anti Rayap  Ampuh Basmi Hama', 'latrex-400-ec-1-l-obat-anti-rayap-ampuh-basmi-hama', '200', '290000', 'Termitisida Obat anti rayap berkonsentrat tinggi untuk membasmi rayap dan juga sebagai bahan pengawet kayu,', '<div>LATREX 400 EC 1 LITER OBAT ANTI RAYAP</div><div>Berat Bersih : 1000 Gram</div><div>Isi Produk : Berbentuk cairan</div><div>1 Dus isi 12 Botol</div>', '0', null, '167258878221.png', '2', '2023-01-01 16:00:52', '2023-01-01 16:00:52');
INSERT INTO `produk` VALUES ('23', '6', 'Agenda 25 EC 1 L Anti Rayap Ampuh  Basmi Hama', 'agenda-25-ec-1-l-anti-rayap-ampuh-basmi-hama', '200', '402500', '<div>Untuk mengendalikan rayap tanah dan kayu</div><div>Mengendalikan rayap hingga koloni</div><div>Bersifat non-repellent dan tidak berbau</div>', '<div>AGENDA 25 EC</div><div>Berat Bersih : 1 Liter</div><div>1 Dus isi 12 Botol</div><div>Isi Produk : Berbentuk cairan</div>', '0', null, '167258883699.png', '2', '2023-01-01 16:00:36', '2023-01-01 16:00:36');
INSERT INTO `produk` VALUES ('24', '6', 'Premise 200 SL 250 ML (Obat Anti  Rayap Ampuh Basmi Hama)', 'premise-200-sl-250-ml-obat-anti-rayap-ampuh-basmi-hama', '200', '270000', '<div>Untuk mengendalikan rayap tanah dan kayu</div><div>Mengendalikan rayap hingga koloni</div><div>Bersifat non-repellent dan tidak berbau</div>', '<div>PREMISE 200 SL</div><div><br></div><div>Berat bersih : 250 ML</div><div>Isi produk : Berbentuk cairan</div>', '0', 'unggulan', '167258923935.png', '2', '2023-01-01 16:07:19', '2023-01-01 16:07:19');
INSERT INTO `produk` VALUES ('25', '6', 'Iplant Care Spray Anti Hama / Pengusir Hama & Pelindung Hama Tanaman', 'iplant-care-spray-anti-hama-pengusir-hama-pelindung-hama-tanaman', '200', '24500', '<div>iPlant Care adalah cairan kimia yang di luncurkan guna mengusir hama penyerang tanaman hias tidak berbahaya aman digunakan, hama adalah hewan yang cepat sekali berkembang biak dalam kondisi apapun karna hewan ini banyak di temukan hewan ini juga membawa (virus, kotoran, dan bau) pasti anda tidak nyaman berdampingan dengan HAMA yang satu ini kan.</div>', '<div>&gt;&gt; BERAT BERSIH 200ML</div>', '0', 'unggulan', '167258928293.png', '2', '2023-01-01 16:08:02', '2023-01-01 16:08:02');
INSERT INTO `produk` VALUES ('26', '6', 'Alat Pengusir Hama Ultrasonik Tenaga Surya Anti Air dengan Sensor Gera', 'alat-pengusir-hama-ultrasonik-tenaga-surya-anti-air-dengan-sensor-gera', '200', '484748', 'Ultrasound &amp; Strong Flash --- Powerful ultrasound matched with strong flash, humanitarianly drive away unwelcome wild animals, protect your life from being disturbed. Adjustable frequency and sensitivity can help control different size of animal', '<div>Color: Green</div><div>Material: ABS and Electronic component</div><div>Waterproof level: IP44</div><div>Power supply: 3 rechargeable batteries 5V 500mA</div><div>Infrared sensor angle: 110 degree</div><div>Frequency range: 13.5kHz-45.5kHz</div>', '0', 'unggulan', '167258940631.png', '2', '2023-01-01 16:10:06', '2023-01-01 16:10:06');
INSERT INTO `produk` VALUES ('27', '6', 'Insect Net/Inseknet Screen Net Putih  Lebar 3 Meter Harga Per Meter', 'insect-netinseknet-screen-net-putih-lebar-3-meter-harga-per-meter', '200', '340000', '<div>Bahan ini banyak digunakan untuk mencegah serangga masuk kedalam rumah, dipasang pada pintu, jendela atau lubang angin. Banyak juga digunakan untuk mencegah serangan serangga hama pada lahan pertanian atau greenhouse.&nbsp;</div>', '<div>Warna : PUTIH</div><div>Spesifikasi : Bentuk anyaman Strimin</div><div>Dimensi : Lebar 100 cm Panjang 50 meter (1 rol)</div><div>Bahan : PolyEthilen</div><div>Net Mesh 50</div>', '0', null, '167258943994.png', '2', '2023-01-01 16:10:39', '2023-01-01 16:10:39');
INSERT INTO `produk` VALUES ('28', '7', 'Water Sprinkler Penyiraman Rotary  Air Taman Kebun', 'water-sprinkler-penyiraman-rotary-air-taman-kebun', '200', '39500', '<div>Dengan sprinkler ini, air akan tersebar dengan merata karena air akan keluar dari beberapa sudut dan kemudian semprotan ini akan berputar sehingga taman akan tersiram secara merata.</div><div>3 Water Head</div><div>Terdapat 3 buah kepala sehingga air dapat keluar dari 3 arah yang berbeda. Dengan desain ini maka taman akan tersiram dengan area yang lebih luas</div>', '<div>Material: advanced ABS Plastic</div><div>Features: 360 degree rotating spray</div><div>Adjustable Spray Directions: Direct or 45Angle</div><div>Dimensions: 5.9\'\'x3.5 \'\'</div><div>Working principle:Hydraulic drive</div>', '0', null, '167258961079.png', '2', '2023-01-01 16:13:30', '2023-01-01 16:13:30');
INSERT INTO `produk` VALUES ('29', '7', 'Evo 100I Solar Powered DIG Timer  Penyiraman Taman Otomatis', 'evo-100i-solar-powered-dig-timer-penyiraman-taman-otomatis', '200', '1350000', '<div>SOLAR POWERED TIMER dari DIG , tidak perlu batere</div><div>Dapat beroperasi di area yang tidak langsung kena matahari /ambient solar</div>', '<div>Material: advanced ABS Plastic</div><div>Features: 360 degree rotating spray</div><div>Adjustable Spray Directions: Direct or 45Angle</div><div>Dimensions: 5.9\'\'x3.5 \'\'</div><div>Working principle:Hydraulic drive</div>', '0', 'favorit', '167259085797.png', '2', '2023-01-01 16:34:17', '2023-01-01 16:34:17');
INSERT INTO `produk` VALUES ('30', '7', 'Selang PVC 4/7MM Untuk Jaringan  Irigasi Penyiraman Tanaman', 'selang-pvc-47mm-untuk-jaringan-irigasi-penyiraman-tanaman', '200', '107000', '<div>Untuk jaringan irigasi penyiraman tanaman menghubungkan head sprayer Sprinkler atau drip tetes.</div><div>Harga per roll</div><div>Stock ready bisa langsung diorde</div>', '<div>Selang irigasi 4/6mm</div><div>Bahan PVC</div><div>Lubang dalam 4mm</div><div>Lingkar Luar 7mm(REAL 6 MM)</div><div>Kuat dan elastis.</div>', '5', null, '167259100251.png', '2', '2023-01-01 16:36:42', '2023-01-01 16:36:42');
INSERT INTO `produk` VALUES ('31', '7', 'Sprinkler Taman Irrigation Pertanian  360 Derajat Penyiraman Otomatis', 'sprinkler-taman-irrigation-pertanian-360-derajat-penyiraman-otomatis', '200', '37000', 'Sprinkler air ini memiliki mekanisme pegas yang membuat sprinkler ini dapat berputar secara terus menerus. Dapat berputar antara 15 hingga 360 derajat.&nbsp;', '<div>Dimensi</div><div>Inner Thread Connector Size: 1/2\"</div><div>Outer Thread Connector Size: 3/4\"</div><div>Total Length: Approx. 29cm / 11.4inch</div><div>Width: Approx: 11.5cm / 4.5inch</div><div>Spray Diameter: 8~12.5m / 26~41ft</div><div>Lain-lain</div><div>Working Pressure: 200~300Kpa</div><div>Water Spraying Quantity: 0.8~1.3m3</div>', '0', 'favorit', '167259131625.png', '2', '2023-01-01 16:41:56', '2023-01-01 16:41:56');
INSERT INTO `produk` VALUES ('32', '7', 'Tekanan TInggu Cuci Mobil Gun Washer Gun Penyiraman Tekanan Tinggi', 'tekanan-tinggu-cuci-mobil-gun-washer-gun-penyiraman-tekanan-tinggi', '200', '37000', '<div>Air pengatur tekanan air dengan twist sederhana.&nbsp;</div><div>Desain kinerja tekanan tinggi, sempurna untuk cuci mobil dan penyiraman berkebun.&nbsp;</div><div>Ini dapat menyemprotkan berbagai bentuk kolom air.&nbsp;</div><div>Terbuat dari bahan bermutu tinggi, tahan lama</div>', '<div>Warna: Seperti yang ditunjukkan.&nbsp;</div><div>Ukuran: 51,5 x 18 x 3,5 cm.&nbsp;</div><div>Bahan: Plastik &amp; tembaga. Jarak&nbsp;</div><div>Spray: 5-15m.&nbsp;</div><div>Tekanan air: 4000psi.</div>', '0', 'favorit', '167259136438.png', '2', '2023-01-01 16:42:44', '2023-01-01 16:42:44');

-- ----------------------------
-- Table structure for `produk_kategori`
-- ----------------------------
DROP TABLE IF EXISTS `produk_kategori`;
CREATE TABLE `produk_kategori` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of produk_kategori
-- ----------------------------
INSERT INTO `produk_kategori` VALUES ('1', 'Bibit', '4j9WtURLwSaXzHisSU8A7cL8nFNLyzFmFlElM2nJ.png', '2023-01-01 10:05:54', '2023-01-01 10:05:54');
INSERT INTO `produk_kategori` VALUES ('2', 'Alat Tani', 'VGyG8VxJ34lPnbCyXmEXt4XqtlFmDDqcgV8QuasG.png', '2023-01-01 13:35:46', '2023-01-01 18:58:17');
INSERT INTO `produk_kategori` VALUES ('3', 'Bahan Konsumsi', '6H5bSTbFmk8PqR2lyi17M07it3rEI3yEcMDJVq4f.png', '2023-01-01 15:23:45', '2023-01-01 15:23:45');
INSERT INTO `produk_kategori` VALUES ('4', 'Sabun', 'Iv3dKXvqIdcc5QgSJt15nyTM93w87jfdYTrvOioy.png', '2023-01-01 15:48:14', '2023-01-01 15:48:14');
INSERT INTO `produk_kategori` VALUES ('5', 'Pupuk', 'M02T8RYTMinFmv7uUFWY4INCaBNdN1QmtmKvCvF3.png', '2023-01-01 15:51:10', '2023-01-01 15:51:10');
INSERT INTO `produk_kategori` VALUES ('6', 'Anti Hama', 'LbhhLHcnZ7MdKvqyimHTPy6kk51gMVmVKjsPKYby.png', '2023-01-01 15:58:38', '2023-01-01 15:58:38');
INSERT INTO `produk_kategori` VALUES ('7', 'Penyiraman', 'zY814xQ0nTb5pCqnxEIJx1n83lPUJcvbj2GE2arI.png', '2023-01-01 16:11:18', '2023-01-01 16:11:18');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'daul', '$2y$10$XSLrexEp1jkPr0Uf1O1gf.HUVWBcV/qvJXuSuw04l3TaBRn/boWFm', 'Daffa Aulia', 'daul@gmail.com', '0876487874578', null, 'L', '2023-01-06', 'Jl. Kencanapuri I No.13, Cijaura, Kec. Buahbatu, Kota Bandung, Jawa Barat 40287', 'JGDs08lV0P0Kju8uPhNLqNxJ97CU7xzXjZtvRwKL.jpg', 'user', null, '2023-01-06 21:03:54');
INSERT INTO `users` VALUES ('2', 'admin', '$2y$10$HBuW3iA49LDlojzWKgoxBeTfMjTzweC1WrRb1u9n7piF4/a7rvfPi', 'Admin Bumi Sawit', 'admin@gmail.com', '1056363520', null, null, null, null, null, 'admin', null, null);
