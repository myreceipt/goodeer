-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Feb 2018 pada 23.47
-- Versi server: 10.1.24-MariaDB-cll-lve
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voucher24jam_demo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `uid` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `created` int(11) NOT NULL,
  `expiry` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`uid`, `data`, `type`, `created`, `expiry`) VALUES
('17a123f6c571fc4d8894864480d1d114', '{\"sources\":{\"360\":{\"file\":\"https://demo.pecintadrama.com/link/DBvopH1UkFxcWda/360/17a123f6c571fc4d8894864480d1d114/\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://demo.pecintadrama.com/link/DBvopH1UkFxcWda/720/17a123f6c571fc4d8894864480d1d114/\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://demo.pecintadrama.com/link/DBvopH1UkFxcWda/480/17a123f6c571fc4d8894864480d1d114/\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"orginal\":{\"360\":{\"file\":\"https://r2---sn-npoeenee.c.drive.google.com/videoplayback?id=3a283e85196d2060&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=m&pl=24&ttl=transient&ei=7tGRWrqMOcGPugX7ooDoDA&susc=dr&driveid=1j14OJQiNXaTYJ_ITLag8f6g7BsF6FXrF&app=explorer&mime=video/mp4&lmt=1519346764159933&mt=1519505791&ip=43.245.186.140&ipbits=0&expire=1519509502&cp=QVNGQUZfWFVOQ1hOOlRRY0ZEMEZtaDNW&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=75F3A8445410E613BAA9D37BC7C6CDFFE42BE69A.17E6A5D08FE3B15E9DB2F9D090883DF5D35C0180&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r2---sn-npoeenee.c.drive.google.com/videoplayback?id=3a283e85196d2060&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=m&pl=24&ttl=transient&ei=7tGRWrqMOcGPugX7ooDoDA&susc=dr&driveid=1j14OJQiNXaTYJ_ITLag8f6g7BsF6FXrF&app=explorer&mime=video/mp4&lmt=1519343086570960&mt=1519505791&ip=43.245.186.140&ipbits=0&expire=1519509502&cp=QVNGQUZfWFVOQ1hOOlRRY0ZEMEZtaDNW&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=18894523A3DCDADAA39D0B8F5A3E7AD0A2EC1B14.31B3E8D503E96881299A91988466495356996F53&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r2---sn-npoeenee.c.drive.google.com/videoplayback?id=3a283e85196d2060&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=m&pl=24&ttl=transient&ei=7tGRWrqMOcGPugX7ooDoDA&susc=dr&driveid=1j14OJQiNXaTYJ_ITLag8f6g7BsF6FXrF&app=explorer&mime=video/mp4&lmt=1519347062928194&mt=1519505791&ip=43.245.186.140&ipbits=0&expire=1519509502&cp=QVNGQUZfWFVOQ1hOOlRRY0ZEMEZtaDNW&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=46789908A1FE1FF05835E7B11D776FC8D9F4AB86.32FD0D63048013E5DF8C2E5E412C7C2AFBD2DDB9&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"preview\":\"https://lh3.googleusercontent.com/Nly5UHgYVGijFHPxmz8ohqmj5i846IKp13JYfvygwYR7qh-S5aVN6Dd87RTDNnczqeWqnUIJmTo=w1280-h720-n\",\"cookies\":[\"DRIVE_STREAM=OPgAC2Hpg4Q\",\"NID=124=ho7bJdNH0srs7LHocKA0v9YyZLJmY-aPLJwjQzVmFF2ZOKnB1STD0hrw8534xpwveh9qFSeXDRUTv6bnuP2W6GZ7f7t_SlPJY9OacRPdQp-Z_QpBKJj7Mx3m0gu6O5CL\",\"NID=124=m7B_EYkVoPrSa01xcetUD3kRjrsudwQlN6mAiSEL6Oh7Eu3F-hP49fLxWfuccxubXS1SLLYUEOD4BmNryj-A_swjTzRGCOkMZ0jBlPPxO1PrN73vZx-EEm3CFuFrNvbQ\"]}', 'drive_embed_player', 1519505903, 1519509503),
('396ab56bc572a80f192c12a4fcf2c4c5', '{\"sources\":{\"360\":{\"file\":\"https://demo.pecintadrama.com/link/79YZ3cSAb5rZGCz/360/396ab56bc572a80f192c12a4fcf2c4c5/\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://demo.pecintadrama.com/link/79YZ3cSAb5rZGCz/720/396ab56bc572a80f192c12a4fcf2c4c5/\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://demo.pecintadrama.com/link/79YZ3cSAb5rZGCz/480/396ab56bc572a80f192c12a4fcf2c4c5/\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"orginal\":{\"360\":{\"file\":\"https://r6---sn-npoe7n76.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n76&ms=nxu&mv=u&pl=24&ttl=transient&ei=sJ-SWtOFI9SNuAKH16CIAg&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510606248444206&mt=1519558068&ip=43.245.186.140&ipbits=0&expire=1519562176&cp=QVNGQUZfUVFVR1hOOkQwNW9SV1lVM0Js&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=8A5A1B904715A1CE99BC987DC5E4D33903028B51.A3777BADB1604733ADC63B50F42BF9DD8DB13212&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r6---sn-npoe7n76.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n76&ms=nxu&mv=u&pl=24&ttl=transient&ei=sJ-SWtOFI9SNuAKH16CIAg&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510604179696008&mt=1519558068&ip=43.245.186.140&ipbits=0&expire=1519562176&cp=QVNGQUZfUVFVR1hOOkQwNW9SV1lVM0Js&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=350C535F1554CD30D1E892A0F71F6392927264CF.74E95FEF994588102952A50669E877F2DCECCC5F&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r6---sn-npoe7n76.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n76&ms=nxu&mv=u&pl=24&ttl=transient&ei=sJ-SWtOFI9SNuAKH16CIAg&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510606456419204&mt=1519558068&ip=43.245.186.140&ipbits=0&expire=1519562176&cp=QVNGQUZfUVFVR1hOOkQwNW9SV1lVM0Js&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=0A54014D332A1268E6991811DB3703471784BFBA.7AEFD1814A01D779D0B8F07FEB1F07AF903622B2&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"preview\":\"https://lh3.googleusercontent.com/qyTv-l9WLNSfWHl99f9ntWslQe-_bmcrU2uqEwn1MdttLf9kmxZzvrDsAPMYrgNx9YBwaCac5Kc=w1280-h720-n\",\"cookies\":[\"DRIVE_STREAM=Y71qUTWX0Eg\",\"NID=124=I7GvZokGtUtT2hsXfMAQJ949e8M49ZRBI2id71mofzP0aJ-ZoYZ7kMrAvNwSv_ir1iEOAV9V9vU4aGhsagqP7EACUVdKQzGC_tT-aV8Rf-BZR3ftsnOqyrMK-DkS_07W\",\"NID=124=D97txBj0cqbLysfD8PSqKxLiw_T3rGWQgEizN0SIBa4bApPraa5qSe47v2AxPwx3IKsF6dw5R1OaFIn9E0OM7i9TujctX-3JG9v1T2QYVjCuFxY--r14VVzdQa1Rd6n_\"]}', 'drive_embed_player', 1519558577, 1519562177),
('67e8c376840f7878023431ca8912d406', '{\"sources\":{\"360\":{\"file\":\"https://demo.pecintadrama.com/link/JwbptI9CMvuLyMd/360/67e8c376840f7878023431ca8912d406/\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"orginal\":{\"360\":{\"file\":\"https://r1---sn-npoe7n7y.c.drive.google.com/videoplayback?id=39babcf757576de2&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7y&ms=nxu&mv=u&pl=24&ttl=transient&ei=Lf-OWqLxEobbuAX8krOYCg&susc=dr&driveid=18RclYbZ9ketKQaJRYA6Lcc7lX0WayMLm&app=explorer&mime=video/mp4&lmt=1518579444316216&mt=1519320181&ip=43.245.186.140&ipbits=0&expire=1519324477&cp=QVNGQURfU1RVSFhOOmk3alhvblkzSWxG&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=3B8F4F2DB1F4BDDAC17628C3F51266CB32A96F96.0705CB31B4041D64525FA0F12655AB885B950A1C&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"preview\":\"https://lh3.googleusercontent.com/GRZ7jpJdqyhrhFab5iR5pjzcNWA_vgHKWyM-VyEkPIDQenGzQ07ExSqjM27VSwErR_WjnoeIIls=w1280-h720-n\",\"cookies\":[\"DRIVE_STREAM=d6lXokV4HoA\",\"NID=124=lhHArh7GdC9DYZX-jEhJOY2wNR_oO09NbsrdPt41XMnRbLiBZ-aLDeAM9lw5FflfED5UmUigSb4wOshv4UMXFF5oFtaz-huB8X2pWZ7ZUm83iyFBMDLFsWh1HNpXiFno\",\"NID=124=DaMPm18neARnNgjol6Ec1WAwKOOHTqjgra4M-CW66c6e_h9K8byfjtIKKbpxp5kKz5ymeMYWbuHH_qoUUR8ETXBKiK8pzq_NO70-BQmqYJRRUHxCgJrYjAtJmlEwyiDz\"]}', 'drive_embed_player', 1519320878, 1519324478);

-- --------------------------------------------------------

--
-- Struktur dari tabel `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `embed` text,
  `slug` varchar(255) NOT NULL,
  `subtitle` text,
  `preview` varchar(500) DEFAULT NULL,
  `title` varchar(300) DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT '3',
  `source` varchar(20) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `date` datetime DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `files`
--

INSERT INTO `files` (`id`, `link`, `embed`, `slug`, `subtitle`, `preview`, `title`, `type`, `source`, `views`, `date`, `user`) VALUES
(7695, 'NDExYmM1MDFhONqmi5ZZR2L2Uah-Z1l2PhpDLLEs7nRvXVZ6TezXRqzY1RX8yzpvNtq38RdsvSwpvyEwy1TkLsr91syfzsdbLpVDWSudS7wXGuUKO2dmCHRmxE7m04pfQKuUdIsCp4PFSMXG0lfqH5GyDW3H2SrL-rcIUtXX0QfPkMpBffDPs_9rDzzabkBdZIV0rlvVTaSppZ4h9D_IWWCU8o-80qUPUAVnD_rVeOee3WJq-RR6zE02-YDkVliEqog', 'https://photos.google.com/share/AF1QipMAAiyGlxlmNjQ5yMHVQUzEiYHaW5Yp_78PjtF53bDKoiM1IoXHMGLP95Cvy9ZoAA/photo/AF1QipOTNZAZ3wrAF7paEDQkUiE8YgM1kzpQ6nr6bLn4?key=UnpINk56dzdZbFM1TGZreUVZTUxGLTNkUWZDa0pB', 'XkaQrNGyxtYmbCQ', 'MzBhMzg4NmZjM_846XGBqD33PK1jSy2ejgG6dUG74nLJXg', NULL, 'Demo Google Photos', 3, 'photo', 12, '2018-02-12 11:27:35', 1),
(7696, 'NjU2MTU5MThkM7GCQPg9xAJ1j0NS97VmoJHhbWCIDdcLfFywHRqKgbQ19b2k8028zee5I9ItHrTrbYXlRL-hTk0Z', 'https://drive.google.com/open?id=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR', '79YZ3cSAb5rZGCz', 'YzY5ZTdlNjZjNdF3zuk13sAIJ6rmg-d2XqiQ03n7L-YYQLcEf29762qUN3uoRPzY2hk', '', 'Demo Google Drive', 3, 'drive', 84, '2018-02-12 11:30:31', 1),
(7697, 'NDZiNTQ4MmIwNQxXVyyo3PDQKdWUqvCYGZ_oVbvsjwFmVZCvMZLVdbRXopVTPx9feKBPky3ThRM5ZN_ExABZODKO', NULL, '0lNMlTIEzuUPfKA', 'MjAyNzYzZDBiOHCoFU_94rrf4BCj7SiB9HAAm5GXm8dltg', NULL, 'edefe', 3, 'drive', 10, '2018-02-12 14:39:21', 1),
(7698, 'Njg1OWJkMzhkNWB_fYh0A4TpCK7zte2bzSDh8CypyjkUUx5Jgot_fJEMt8shRlJd7bplTw_AlP4QakebLdv0Vzxl', '', 'GqO4IhrtLdn33rP', 'MDMwZDNjNDM2M1rQ7LhO-41rchcWtnwPFNeGki4WbgYcJg', '', '', 3, 'drive', 4, '2018-02-14 00:38:44', 1),
(7699, 'OWU4NzIwMGIzNhjoSkzBliuFERseMhnqpfJfLg0Lj8Cxx6Ph6Ox-aE7vTbZ_e6dNn3-VzvvC8VymmeAEwF5osVbo', '', 'kTJbC1tJ4nJyggE', 'MGJhZjVlODM0OG8C6mkVhT8fSc87rNyC7pCGh-nkbgy1cw', '', '', 3, 'drive', 5, '2018-02-14 00:39:51', 1),
(7700, 'ZWFkZDg1ZjgyOAIlLJP1Yw29U51sBrd0AftaLujtES2R1tk9aRP0uZGY-Vzrbl5kghW6lKsySIW8sCXCW3gRcH9_', NULL, 'jdwLzF4X3BeBVnd', 'NzVhNWQwM2I4MANeKOne27eJuS3cS2HeioZ4IQYBavonng', NULL, NULL, 3, 'drive', 4, '2018-02-14 00:40:38', 1),
(7701, 'NmM5OTAyYWI3MSKhiC0Nl6xq2KYMiIJsSwXucLNYRiDluF_mWdkUnbelF_CPcxMzCYuIWpxADcZMhsCPAzlEWK86', 'https://drive.google.com/open?id=117C2gRKIkaNVfxGB9E0HZeLeadTF67WP', 'JwbptI9CMvuLyMd', 'MjNhNzVkNTViNhMpNzX8P6aTMmrDv3BWzbC1B2SsNStLAB6v5whnCHmqheWQ9HaBAyw', '', 'Eurachacha_Waikiki.E04', 3, 'drive', 16, '2018-02-14 04:18:25', 1),
(7702, 'MjFjNTQ2OTFiZt25Xv8dENYWp-cVakb8VBlpnVT7Bdd3CNgl5AerRoA2AF7Wl5Oat9o', NULL, 'bC9cNSxQ1CYTS1M', 'ZmY0ZmU4OTIwMdqfsq4xhudVwX-09GYqsrYwQUeauzXTOw', NULL, 'test', 3, 'drive', 10, '2018-02-15 14:23:51', 1),
(7705, 'ODVhZTAwYjE0YxAtTS2QSZRhoV5rNMyHfhLJenzjw34tqSBVL5XYljW0L0tDeUusSdU', '', 'UPNPvt1jPiaPa14', 'MGYxZjBmNjcyOYKQJoESmixYxaHJs3KTENOhvS7DfJlesQ', '', 'limit video', 3, 'drive', 8, '2018-02-19 22:56:25', 1),
(7707, 'YjYzNTRiMTNhMALLRVr3HBTzxSDniwlAbW1lKfdR5qyblQ3T1xmBHDaFz9APtEzvbwL5mLfbfuKM5H94qBtEFpcV', NULL, 'DBvopH1UkFxcWda', 'M2Y1MjZiMDcwZCPwa-xntTloSBDJPKMmuIAsXxrcBbhE-Q', NULL, NULL, 3, 'drive', 1, '2018-02-24 17:58:09', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `links`
--

CREATE TABLE `links` (
  `uid` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `links`
--

INSERT INTO `links` (`uid`, `data`, `type`, `added`) VALUES
('0b405d04c0921a15382932506816a060', '{\"sources\":{\"360\":{\"file\":\"https://r1---sn-npoeenee.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=u&pl=24&ttl=transient&ei=q5CJWsXTDoOPuQKbj5bABQ&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510606248444206&mt=1518964629&ip=43.245.186.140&ipbits=0&expire=1518968507&cp=QVNGWkpfV1VOSFhOOkQyaC1oaUdrVThh&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=1482A1E6F45DA79A03F8A7796E851AC858DEA0F3.9BCDB4B34CFCEED0E98D4927D649BA6BA0ECA6&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r1---sn-npoeenee.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=u&pl=24&ttl=transient&ei=q5CJWsXTDoOPuQKbj5bABQ&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510604179696008&mt=1518964629&ip=43.245.186.140&ipbits=0&expire=1518968507&cp=QVNGWkpfV1VOSFhOOkQyaC1oaUdrVThh&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=93C05C44C4B66CFD3541108159F2AED92B8EB551.A42B7D38A2CF512E1C64A5E96C52BC5AA6F08BDE&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r1---sn-npoeenee.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=u&pl=24&ttl=transient&ei=q5CJWsXTDoOPuQKbj5bABQ&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510606456419204&mt=1518964629&ip=43.245.186.140&ipbits=0&expire=1518968507&cp=QVNGWkpfV1VOSFhOOkQyaC1oaUdrVThh&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=78FC7C0BCADB51B050C49B53BD03B85754BF4C62.85BBE1F88D39C756180DA5F29273C0EBD5A99E23&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=Z5f-gmDnT9w\",\"NID=124=XKy4KwfTfJCIqj8C52NBsus2O3l5b6Z8JGMgAvXz6LVggTYAQFQLHmB_j6m3JmiXkcLFfphafTGuU7rvAGBcqP4lWQjG_MBt2-sOTFlsOQglyyI5FeKQ1R_-vlODM4K9\",\"NID=124=KkdOfL5slxT_XBBEdBbEPO4nbdaQfxFEQJ_eHrns5jUVo_ELQHMFXWVmtJKCoslCfmwwJFedEZsNlOIPVe2TyEmYUFYhg17J7TuomL5rxYbK6bPRuT8rUxmzjXkrAVpW\"]}', 'video_download', 1518964908),
('17a123f6c571fc4d8894864480d1d114', '{\"sources\":{\"360\":{\"file\":\"https://r2---sn-npoeenee.c.drive.google.com/videoplayback?id=3a283e85196d2060&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=m&pl=24&ttl=transient&ei=7tGRWrqMOcGPugX7ooDoDA&susc=dr&driveid=1j14OJQiNXaTYJ_ITLag8f6g7BsF6FXrF&app=explorer&mime=video/mp4&lmt=1519346764159933&mt=1519505791&ip=43.245.186.140&ipbits=0&expire=1519509502&cp=QVNGQUZfWFVOQ1hOOlRRY0ZEMEZtaDNW&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=75F3A8445410E613BAA9D37BC7C6CDFFE42BE69A.17E6A5D08FE3B15E9DB2F9D090883DF5D35C0180&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r2---sn-npoeenee.c.drive.google.com/videoplayback?id=3a283e85196d2060&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=m&pl=24&ttl=transient&ei=7tGRWrqMOcGPugX7ooDoDA&susc=dr&driveid=1j14OJQiNXaTYJ_ITLag8f6g7BsF6FXrF&app=explorer&mime=video/mp4&lmt=1519343086570960&mt=1519505791&ip=43.245.186.140&ipbits=0&expire=1519509502&cp=QVNGQUZfWFVOQ1hOOlRRY0ZEMEZtaDNW&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=18894523A3DCDADAA39D0B8F5A3E7AD0A2EC1B14.31B3E8D503E96881299A91988466495356996F53&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r2---sn-npoeenee.c.drive.google.com/videoplayback?id=3a283e85196d2060&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=m&pl=24&ttl=transient&ei=7tGRWrqMOcGPugX7ooDoDA&susc=dr&driveid=1j14OJQiNXaTYJ_ITLag8f6g7BsF6FXrF&app=explorer&mime=video/mp4&lmt=1519347062928194&mt=1519505791&ip=43.245.186.140&ipbits=0&expire=1519509502&cp=QVNGQUZfWFVOQ1hOOlRRY0ZEMEZtaDNW&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=46789908A1FE1FF05835E7B11D776FC8D9F4AB86.32FD0D63048013E5DF8C2E5E412C7C2AFBD2DDB9&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=OPgAC2Hpg4Q\",\"NID=124=ho7bJdNH0srs7LHocKA0v9YyZLJmY-aPLJwjQzVmFF2ZOKnB1STD0hrw8534xpwveh9qFSeXDRUTv6bnuP2W6GZ7f7t_SlPJY9OacRPdQp-Z_QpBKJj7Mx3m0gu6O5CL\",\"NID=124=m7B_EYkVoPrSa01xcetUD3kRjrsudwQlN6mAiSEL6Oh7Eu3F-hP49fLxWfuccxubXS1SLLYUEOD4BmNryj-A_swjTzRGCOkMZ0jBlPPxO1PrN73vZx-EEm3CFuFrNvbQ\"]}', 'embed_player', 1519505903),
('396ab56bc572a80f192c12a4fcf2c4c5', '{\"sources\":{\"360\":{\"file\":\"https://r6---sn-npoe7n76.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n76&ms=nxu&mv=u&pl=24&ttl=transient&ei=sJ-SWtOFI9SNuAKH16CIAg&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510606248444206&mt=1519558068&ip=43.245.186.140&ipbits=0&expire=1519562176&cp=QVNGQUZfUVFVR1hOOkQwNW9SV1lVM0Js&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=8A5A1B904715A1CE99BC987DC5E4D33903028B51.A3777BADB1604733ADC63B50F42BF9DD8DB13212&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r6---sn-npoe7n76.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n76&ms=nxu&mv=u&pl=24&ttl=transient&ei=sJ-SWtOFI9SNuAKH16CIAg&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510604179696008&mt=1519558068&ip=43.245.186.140&ipbits=0&expire=1519562176&cp=QVNGQUZfUVFVR1hOOkQwNW9SV1lVM0Js&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=350C535F1554CD30D1E892A0F71F6392927264CF.74E95FEF994588102952A50669E877F2DCECCC5F&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r6---sn-npoe7n76.c.drive.google.com/videoplayback?id=d82e8a06549723b5&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n76&ms=nxu&mv=u&pl=24&ttl=transient&ei=sJ-SWtOFI9SNuAKH16CIAg&susc=dr&driveid=1eK2BP5AdaqkpSPV1wZwGOLV_HKD46FMR&app=explorer&mime=video/mp4&lmt=1510606456419204&mt=1519558068&ip=43.245.186.140&ipbits=0&expire=1519562176&cp=QVNGQUZfUVFVR1hOOkQwNW9SV1lVM0Js&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=0A54014D332A1268E6991811DB3703471784BFBA.7AEFD1814A01D779D0B8F07FEB1F07AF903622B2&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=Y71qUTWX0Eg\",\"NID=124=I7GvZokGtUtT2hsXfMAQJ949e8M49ZRBI2id71mofzP0aJ-ZoYZ7kMrAvNwSv_ir1iEOAV9V9vU4aGhsagqP7EACUVdKQzGC_tT-aV8Rf-BZR3ftsnOqyrMK-DkS_07W\",\"NID=124=D97txBj0cqbLysfD8PSqKxLiw_T3rGWQgEizN0SIBa4bApPraa5qSe47v2AxPwx3IKsF6dw5R1OaFIn9E0OM7i9TujctX-3JG9v1T2QYVjCuFxY--r14VVzdQa1Rd6n_\"]}', 'embed_player', 1519558577),
('4616d37e41df9bf5b7724e6f51606034', '{\"sources\":{\"360\":{\"file\":\"https://r6---sn-npoeen76.c.drive.google.com/videoplayback?id=ea9fac78e9d5ad75&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeen76&ms=nxu&mv=u&pl=24&ttl=transient&ei=y9SDWr6gE5rKuwWy6Y7wCA&susc=dr&driveid=1mOW5iiI3RgDzFNacah_raNIjO1Fe9nx6&app=explorer&mime=video/mp4&lmt=1514656290427396&mt=1518588337&ip=43.245.186.140&ipbits=0&expire=1518592731&cp=QVNGWkZfUVdRQlhOOm9hZGtFUHVTQVVD&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=B3C9B559E4516762AD06528C31049A76306AEF4C.54AF50124E72F7B7C1F5395BAA4E796827F71E&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=kzymBQxVZXY\",\"NID=123=YCST7reldU2kIrKhn9LVozgBciVAHLK15LO7Ew1h1VstCBmLNNeDfcZ2N_XK1JyDY1cC5SVO6fw3ghipmz2_doRlIUkds13o4XfyfI5-6tYR-917E7xkm96HUU2Hd1ne\",\"NID=123=BbAZFX4chpQRxcCvb-rYn0YuvTiQ6_S_jVDpzLshRmtAKvWApEq7zWbsmDUDUrWPwi_TEkNbeAogrjw87-O2ASUizCF8preKjKmLCT_qg3_usyvs87LlNmxBw9XXB_QF\"]}', 'embed_player', 1518589133),
('48f909635ff697cc073c06c7d4712601', '{\"sources\":{\"360\":{\"file\":\"https://r5---sn-npoe7n7z.c.drive.google.com/videoplayback?id=947e2da453ef37b0&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7z&ms=nxu&mv=u&pl=24&ttl=transient&ei=xBeMWt-SK8zMuAXSp4KoBw&susc=dr&driveid=0ByaRd0R0Qyatcmw2dVhQS0NDU0U&app=explorer&mime=video/mp4&lmt=1478861408556243&mt=1519129779&ip=43.245.186.140&ipbits=0&expire=1519134164&cp=QVNGQUJfU1FURVhOOnFra0pQTHdiMmZO&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=5138F90D7C7505B1EA2580BF6E872F74E8E42D41.BA7911A2425B9B348C9E3A9ECFFDFAE4287EBD0E&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r5---sn-npoe7n7z.c.drive.google.com/videoplayback?id=947e2da453ef37b0&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7z&ms=nxu&mv=u&pl=24&ttl=transient&ei=xBeMWt-SK8zMuAXSp4KoBw&susc=dr&driveid=0ByaRd0R0Qyatcmw2dVhQS0NDU0U&app=explorer&mime=video/mp4&lmt=1478861692910874&mt=1519129779&ip=43.245.186.140&ipbits=0&expire=1519134164&cp=QVNGQUJfU1FURVhOOnFra0pQTHdiMmZO&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=B347E782A61A7CC9F1F37831E9F9C1C56CD02BB2.A08F9932CBE8BE9F05C993A3BF8C6AD05D03062C&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r5---sn-npoe7n7z.c.drive.google.com/videoplayback?id=947e2da453ef37b0&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7z&ms=nxu&mv=u&pl=24&ttl=transient&ei=xBeMWt-SK8zMuAXSp4KoBw&susc=dr&driveid=0ByaRd0R0Qyatcmw2dVhQS0NDU0U&app=explorer&mime=video/mp4&lmt=1478861689517828&mt=1519129779&ip=43.245.186.140&ipbits=0&expire=1519134164&cp=QVNGQUJfU1FURVhOOnFra0pQTHdiMmZO&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=501A0C3C843181FE89A6C61CE72541406BBACC24.9249EAB092FDD4346A44CC477A020B9260D6CD4D&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=lnlJSJwe9iI\",\"NID=124=ZvcmltiUpZdZH_LHQ25DoxpQGHF7NyZ8xXJ0-Nrkc4Ix4wyPcdWOZhVd2xqtgQy1U9zOVxINSNVU6fR6itBrzB1pn_axis-FI-pYN8GNJGsf6At5Ar-Jz0Gi8kjqbYIO\",\"NID=124=UBaq07usPgllmLJZA3sF0J1JiCMUU9NISlOUypPAqQ5gM9RVyAwsfh90MsctP1OcdmfcOPpY3NNz8a3cnKbbhxwA6zvDQzvoiDoTxWmPWW24L2aWPRVNyu8BpmXfZqZg\"]}', 'embed_player', 1519130572),
('4c9c52dce41c9f849689bb0836534aa2', '{\"sources\":{\"360\":{\"file\":\"https://r6---sn-npoeen76.c.drive.google.com/videoplayback?id=ea9fac78e9d5ad75&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeen76&ms=nxu&mv=u&pl=24&ttl=transient&ei=_EOGWpmWFISCuAXt6KvoDw&susc=dr&driveid=1mOW5iiI3RgDzFNacah_raNIjO1Fe9nx6&app=explorer&mime=video/mp4&lmt=1514656290427396&mt=1518748014&ip=43.245.186.140&ipbits=0&expire=1518752268&cp=QVNGWkhfUVJUSVhOOlpaYk5rMlVDTFN3&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=6771BFC2FCFB2FBFC1AEABB7219AF8A1F9FA000F.13F94A98310E05B24EDD2F09ACCDB1C42736C740&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=VWaPm8QFKVs\",\"NID=123=mWXTxDbWGNATu2tOIlHWFCw8dRHx5_sGebuyIj4XoNooHH4-xCPw0HA1PD-TcMT_oLL_K0m_-qEpAQh0YqDZ8Z9V4KRovdU463_rszcs2NNv4QcN7jNdxGkp6gICtdsm\",\"NID=123=eSEHvMV2NvEY5BfZr_XvZ9CQ8WcXyNBLyQF9BdZULWc4YtrSp0tHr6cHivH0JY3vieEndqY4zCHEGrW1xuytl4MEVVjs-lBYXttpk29SoE2AKEnSokNyhgGAPHwZiQDg\"]}', 'video_download', 1518748669),
('4e2c999e1e40b79e901a84afd179a980', '{\"sources\":{\"720\":{\"file\":\"https://lh3.googleusercontent.com/e0MgsCmFxqPLRujScHtPX9vIOkgIBxzFBYxF5d0QjOFKkAs-u2TDBglToxpIQ4bW6OW1lCRKsoI2htgiMBTy3DcICCcOjl2NpzeV3zKjmUY6eYMknohIr4aHViRBHAcgfkoiN_9iRw=m22\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"360\":{\"file\":\"https://lh3.googleusercontent.com/e0MgsCmFxqPLRujScHtPX9vIOkgIBxzFBYxF5d0QjOFKkAs-u2TDBglToxpIQ4bW6OW1lCRKsoI2htgiMBTy3DcICCcOjl2NpzeV3zKjmUY6eYMknohIr4aHViRBHAcgfkoiN_9iRw=m18\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":null}', 'embed_player', 1518653947),
('53de33d6cfc1f2bae3e575a832e4f51f', '{\"sources\":{\"720\":{\"file\":\"https://lh3.googleusercontent.com/e0MgsCmFxqPLRujScHtPX9vIOkgIBxzFBYxF5d0QjOFKkAs-u2TDBglToxpIQ4bW6OW1lCRKsoI2htgiMBTy3DcICCcOjl2NpzeV3zKjmUY6eYMknohIr4aHViRBHAcgfkoiN_9iRw=m22\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"360\":{\"file\":\"https://lh3.googleusercontent.com/e0MgsCmFxqPLRujScHtPX9vIOkgIBxzFBYxF5d0QjOFKkAs-u2TDBglToxpIQ4bW6OW1lCRKsoI2htgiMBTy3DcICCcOjl2NpzeV3zKjmUY6eYMknohIr4aHViRBHAcgfkoiN_9iRw=m18\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":null}', 'video_download', 1518700129),
('67e8c376840f7878023431ca8912d406', '{\"sources\":{\"360\":{\"file\":\"https://r1---sn-npoe7n7y.c.drive.google.com/videoplayback?id=39babcf757576de2&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7y&ms=nxu&mv=u&pl=24&ttl=transient&ei=Lf-OWqLxEobbuAX8krOYCg&susc=dr&driveid=18RclYbZ9ketKQaJRYA6Lcc7lX0WayMLm&app=explorer&mime=video/mp4&lmt=1518579444316216&mt=1519320181&ip=43.245.186.140&ipbits=0&expire=1519324477&cp=QVNGQURfU1RVSFhOOmk3alhvblkzSWxG&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=3B8F4F2DB1F4BDDAC17628C3F51266CB32A96F96.0705CB31B4041D64525FA0F12655AB885B950A1C&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=d6lXokV4HoA\",\"NID=124=lhHArh7GdC9DYZX-jEhJOY2wNR_oO09NbsrdPt41XMnRbLiBZ-aLDeAM9lw5FflfED5UmUigSb4wOshv4UMXFF5oFtaz-huB8X2pWZ7ZUm83iyFBMDLFsWh1HNpXiFno\",\"NID=124=DaMPm18neARnNgjol6Ec1WAwKOOHTqjgra4M-CW66c6e_h9K8byfjtIKKbpxp5kKz5ymeMYWbuHH_qoUUR8ETXBKiK8pzq_NO70-BQmqYJRRUHxCgJrYjAtJmlEwyiDz\"]}', 'embed_player', 1519320878),
('6fd0467f9bf1c588f5c708ba59be2984', '{\"sources\":{\"360\":{\"file\":\"https://r5---sn-npoeen7d.c.drive.google.com/videoplayback?id=dbbf9886ccb9acf9&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeen7d&ms=nxu&mv=m&pl=24&ttl=transient&ei=WdGRWv_BOIrLuQXYsqPwCw&susc=dr&driveid=0B_G8i6Xv6MNyUEZsQTdHMk9SSk0&app=explorer&mime=video/mp4&lmt=1508332064158247&mt=1519505662&ip=43.245.186.140&ipbits=0&expire=1519509353&cp=QVNGQUZfWFNTRFhOOlNEMzVVTE84Vktw&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=21B5846694F11BF35A0825BD046E057D1729C673.0A022B289555B2BD0B3FB1C754F9E5711C842C93&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=NC58VKP9UNk\",\"NID=124=baUlbWG2vSZCWLNLVlelV-XpXuW1qL-Hufnl7Mi1w--c7nvMuYzVWRcHqh0RjDfajrII-qqN6R_dfVNi7_tl_ZPZWv-RwJ16P8K0xXSD5GxXoBKJ0yJXu2s4m42UHuwF\",\"NID=124=ZyqC-wzBVhRmzfOfWO5suxrEQmlF_Ab5COVOGiDAMqpiMjJ2g6uM4_Ilxk79SHgA30kI5tiDNOPf02ZltfLM2jOxwKDnqmw4bg-GH8jPYd9pRrt3a6t81KBFtMDMOv1G\"]}', 'embed_player', 1519505754),
('78124ff9b10416b0d195feac0e595890', '{\"sources\":{\"360\":{\"file\":\"https://r5---sn-npoe7n7z.c.drive.google.com/videoplayback?id=947e2da453ef37b0&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7z&ms=nxu&mv=u&pl=24&ttl=transient&ei=ry6NWvaBCMSQugK6-I-IAw&susc=dr&driveid=0ByaRd0R0Qyatcmw2dVhQS0NDU0U&app=explorer&mime=video/mp4&lmt=1478861408556243&mt=1519201434&ip=43.245.186.140&ipbits=0&expire=1519205567&cp=QVNGQUNfVFVUSFhOOnczemFwLUJhTDVS&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=9FFF72494ECB1E98C25BC2EB115D9C14162A344A.2A5F34A1082D3660380B6BAC04B13135FE9D3204&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"},\"720\":{\"file\":\"https://r5---sn-npoe7n7z.c.drive.google.com/videoplayback?id=947e2da453ef37b0&itag=22&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7z&ms=nxu&mv=u&pl=24&ttl=transient&ei=ry6NWvaBCMSQugK6-I-IAw&susc=dr&driveid=0ByaRd0R0Qyatcmw2dVhQS0NDU0U&app=explorer&mime=video/mp4&lmt=1478861692910874&mt=1519201434&ip=43.245.186.140&ipbits=0&expire=1519205567&cp=QVNGQUNfVFVUSFhOOnczemFwLUJhTDVS&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=5320F77EDDA49B628A24149B795CF1517A4ACE00.AA9E1E529C41C9B659314BE709D6BE371AE6DBDC&key=ck2\",\"label\":\"720P\",\"type\":\"video/mp4\"},\"480\":{\"file\":\"https://r5---sn-npoe7n7z.c.drive.google.com/videoplayback?id=947e2da453ef37b0&itag=59&source=webdrive&requiressl=yes&mm=30&mn=sn-npoe7n7z&ms=nxu&mv=u&pl=24&ttl=transient&ei=ry6NWvaBCMSQugK6-I-IAw&susc=dr&driveid=0ByaRd0R0Qyatcmw2dVhQS0NDU0U&app=explorer&mime=video/mp4&lmt=1478861689517828&mt=1519201434&ip=43.245.186.140&ipbits=0&expire=1519205567&cp=QVNGQUNfVFVUSFhOOnczemFwLUJhTDVS&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=322CBC109647C536D580BB648D3B4CC3A48389CA.3FB5BA431C455450BC8FAC38758887AC1ACDEC8C&key=ck2\",\"label\":\"480P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=r3dzo-YdK6M\",\"NID=124=OEBzjRCxfRrT4HYiil4Q8W4pCzIfzFPr2WarlyxHAhdimoaIoyuRhZQ0GVrkGtb6p9hxnXHi4YnoCTB335wiK5L-WEtJ6fI6nOJmsIz5BhSC8jDnI5b0blPV8uHJWpqD\",\"NID=124=PfF4phID9FvoS7LaQ8cxWSO2hoBZ9ZoIoyUvlegMt718qLh4u3nhrP7rmEMwucStKkkmr-fgZL3boapPKpfvW5IKcgitcTMuSw0dplOEo3jAC0S_FRi6-hjm1DtZhnlw\"]}', 'video_download', 1519201969),
('ae241a73eb86a8d64b29dbff3f6f97b8', '{\"sources\":{\"360\":{\"file\":\"https://r1---sn-npoeenee.c.drive.google.com/videoplayback?id=39babcf757576de2&itag=18&source=webdrive&requiressl=yes&mm=30&mn=sn-npoeenee&ms=nxu&mv=u&pl=24&ttl=transient&ei=7PyEWtDlL9XFuQX9r4q4BQ&susc=dr&driveid=18RclYbZ9ketKQaJRYA6Lcc7lX0WayMLm&app=explorer&mime=video/mp4&lmt=1518579444316216&mt=1518664475&ip=43.245.186.140&ipbits=0&expire=1518668540&cp=QVNGWkdfV1VSQVhOOjZtZ0o2ckdkR2ow&sparams=ip%2Cipbits%2Cexpire%2Cid%2Citag%2Csource%2Crequiressl%2Cmm%2Cmn%2Cms%2Cmv%2Cpl%2Cttl%2Cei%2Csusc%2Cdriveid%2Capp%2Cmime%2Clmt%2Ccp&signature=B41A9F60DAD4A32F1FF42E07CB6FAA7F5D435EEE.5E3BCCEA865BDD6570D1FDC8C5D57159671A4B41&key=ck2\",\"label\":\"360P\",\"type\":\"video/mp4\"}},\"cookies\":[\"DRIVE_STREAM=0keF3rKgFm4\",\"NID=123=aSoxKwi1NiFakR1ymXq0J51nP6YDAZA3ZbPHG_YYkEMrikv5Be5450Vm8kBrkM7u0czHaR52JFuzqNjPoRVi_Rfx8ZybKTbmjSEFmZgdXAA_1rQUrmnr3nDC17QHbkW1\",\"NID=123=lLnTJqYpYM6iDae15sbIXJN5Oa4bDPLrpwb6Jt4nxEqP8WC9seO9ATCzfBHlLdkvK6rValw9zef6vFAJGx6MRXBCDzJGbxZIXwOW5v5kbDF09UJKL3Bpi1zWdfuPSGeG\"]}', 'video_download', 1518664942);

-- --------------------------------------------------------

--
-- Struktur dari tabel `loginlog`
--

CREATE TABLE `loginlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `info` text NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `loginlog`
--

INSERT INTO `loginlog` (`id`, `uid`, `info`, `datetime`) VALUES
(211, 1, 'false', '2018-02-22 11:32:12'),
(212, 1, 'false', '2018-02-22 14:33:46'),
(213, 1, '{\"as\":\"AS17974 PT Telekomunikasi Indonesia\",\"city\":\"Semarang\",\"country\":\"Indonesia\",\"countryCode\":\"ID\",\"isp\":\"PT Telkom Indonesia\",\"lat\":-6.9932,\"lon\":110.4203,\"org\":\"PT Telkom Indonesia\",\"query\":\"36.84.29.44\",\"region\":\"JT\",\"regionName\":\"Central Java\",\"timezone\":\"Asia/Jakarta\",\"zip\":\"\"}', '2018-02-24 07:04:20'),
(214, 1, '{\"as\":\"AS131178 OpenNet ISP Cambodia\",\"city\":\"Phnom Penh\",\"country\":\"Cambodia\",\"countryCode\":\"KH\",\"isp\":\"OpenNet ISP Cambodia\",\"lat\":11.5625,\"lon\":104.916,\"org\":\"OpenNet ISP Cambodia\",\"query\":\"103.12.162.4\",\"region\":\"12\",\"regionName\":\"Phnom Penh\",\"timezone\":\"Asia/Phnom_Penh\",\"zip\":\"\"}', '2018-02-24 17:47:23'),
(215, 1, 'false', '2018-02-25 02:59:18'),
(216, 1, '{\"as\":\"AS131178 OpenNet ISP Cambodia\",\"city\":\"Phnom Penh\",\"country\":\"Cambodia\",\"countryCode\":\"KH\",\"isp\":\"OpenNet ISP Cambodia\",\"lat\":11.5625,\"lon\":104.916,\"org\":\"OpenNet ISP Cambodia\",\"query\":\"103.12.162.4\",\"region\":\"12\",\"regionName\":\"Phnom Penh\",\"timezone\":\"Asia/Phnom_Penh\",\"zip\":\"\"}', '2018-02-25 12:45:24'),
(217, 1, '{\"as\":\"AS131178 OpenNet ISP Cambodia\",\"city\":\"Phnom Penh\",\"country\":\"Cambodia\",\"countryCode\":\"KH\",\"isp\":\"OpenNet ISP Cambodia\",\"lat\":11.5625,\"lon\":104.916,\"org\":\"OpenNet ISP Cambodia\",\"query\":\"103.12.162.4\",\"region\":\"12\",\"regionName\":\"Phnom Penh\",\"timezone\":\"Asia/Phnom_Penh\",\"zip\":\"\"}', '2018-02-25 13:39:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'url', 'https://demo.pecintadrama.com'),
(2, 'license', ''),
(3, 'embed_slug', 'video'),
(4, 'download_slug', 'download'),
(5, 'logo', ''),
(6, 'default_title', 'Pecinta Drama'),
(7, 'default_preview', '{ASSETS}/no-preview.png'),
(8, 'default_video', '{ASSETS}/no-video.mp4'),
(9, 'timezone', 'America/Sao_Paulo'),
(10, 'page_limit', '15'),
(11, 'subtitle', 'on'),
(12, 'auto_cc', 'enable'),
(13, 'auto_preview', 'enable'),
(14, 'custom_preview', 'show'),
(15, 'embed_player', 'enable'),
(16, 'file_download', 'enable'),
(17, 'player', 'jwplayer'),
(18, 'jwp_key', 'IMtAJf5X9E17C1gol8B45QJL5vWOCxYUDyznpA=='),
(19, 'about_text', ''),
(20, 'about_link', ''),
(21, 'width', '100%'),
(22, 'height', '100%'),
(23, 'aspect_ratio', '16:9'),
(24, 'player_controls', 'true'),
(25, 'autostart', 'false'),
(26, 'primary', 'html5'),
(27, 'font_size', '14'),
(28, 'font_color', '#efbb00'),
(29, 'font_family', 'Trebuchet MS, Sans Serif'),
(30, 'bg_color', 'rgba(0, 0, 0, 0.4);'),
(31, 'share_btn', 'off'),
(32, 'dl_btn', 'off'),
(33, 'caching', 'on'),
(34, 'cache_expire', '1'),
(35, 'allowed_qualities', '1080p,720p,480p,360p'),
(36, 'quality_order', 'desc'),
(37, 'minify_html', 'enable'),
(38, 'encrypt_js', 'enable'),
(39, 'accs_restriction', 'disable'),
(40, 'allowed_domains', 'google.com'),
(41, 'pop_ad', 'disable'),
(42, 'pop_ad_code', 'PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiIHNyYz0iLy9nby5wdWIyc3J2LmNvbS9hcHUucGhwP3pvbmVpZD0xMzg2ODc0Ij48L3NjcmlwdD4='),
(43, 'banner_ad', 'disable'),
(44, 'banner_ad_code', 'PGEgaHJlZj0iaHR0cHM6Ly93d3cudnVsdHIuY29tLz9yZWY9NzE3NDQ0NyI+PGltZyBzcmM9Imh0dHBzOi8vd3d3LnZ1bHRyLmNvbS9tZWRpYS9iYW5uZXJfMy5wbmciIHdpZHRoPSIzMDAiIGhlaWdodD0iMjUwIj48L2E+'),
(45, 'login_log', 'enable'),
(46, 'blocked_countries', ''),
(47, 'blocked_ips', ''),
(48, 'rely', 'core'),
(49, 'chunk_size', '5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stats`
--

CREATE TABLE `stats` (
  `date` date NOT NULL DEFAULT '0000-00-00',
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stats`
--

INSERT INTO `stats` (`date`, `views`) VALUES
('2018-02-12', 49),
('2018-02-13', 15),
('2018-02-14', 33),
('2018-02-15', 12),
('2018-02-16', 6),
('2018-02-17', 5),
('2018-02-18', 13),
('2018-02-19', 8),
('2018-02-20', 7),
('2018-02-21', 3),
('2018-02-22', 6),
('2018-02-24', 3),
('2018-02-25', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `pass`, `name`, `role`, `status`, `date`) VALUES
(1, 'demo@demo.com', '$2y$10$ozmR2f4S/bZjSz6H4xwJ6eTukde.3KdaMfZSIDskQkbPKnNwaYJKi', 'Demo', 1, 1, '2017-07-30 15:08:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`uid`,`type`);

--
-- Indeks untuk tabel `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`uid`);

--
-- Indeks untuk tabel `loginlog`
--
ALTER TABLE `loginlog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`date`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7708;

--
-- AUTO_INCREMENT untuk tabel `loginlog`
--
ALTER TABLE `loginlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
