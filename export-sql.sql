-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 11 déc. 2017 à 10:58
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `davivvpf_delices`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment_recipe`
--

CREATE TABLE `comment_recipe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cooking_recipe_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `note` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comment_recipe`
--

INSERT INTO `comment_recipe` (`id`, `user_id`, `cooking_recipe_id`, `date`, `content`, `note`) VALUES
(1, 5, 1, '2017-11-12 22:13:42', 'Superbe recette !', 4),
(2, 6, 5, '2017-11-20 10:40:53', 'Votre recette a eu un franc succès !', 5),
(3, 7, 2, '2017-11-27 15:01:37', 'Cette recette n\'est pas au point.', 2),
(5, 8, 2, '2017-11-27 16:25:53', 'Excellente recette, j\'y rajoute de la crème fraîche .', 4),
(6, 4, 2, '2017-11-29 13:47:36', 'Nous trouvons que les fajitas manquent de goût !', 2),
(7, 2, 2, '2017-11-29 15:04:35', 'On a adoré, c\'était excellent !', 5),
(8, 8, 3, '2017-11-29 15:29:59', 'Très bon merci pour la recette !', 4),
(9, 7, 9, '2017-11-30 10:42:24', 'Idéal pour les apéritifs !', 4),
(10, 6, 6, '2017-12-04 09:55:33', 'Simple à faire et efficace !', 4),
(11, 8, 1, '2017-12-11 10:56:12', 'Correct, mais à améliorer', 3),
(12, 8, 5, '2017-12-11 10:57:56', 'Un vrai régal', 5);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `firstName`, `email`, `subject`, `message`) VALUES
(1, 'Alfaro-Chiva', 'David', 'crazy_latino@hotmail.fr', 'Créer une recette', 'Bonjour,\r\n\r\nJe voudrais ajouter une recette, es-ce possible ?'),
(2, 'Forteroche', 'Jean', 'david.alfaro@hotmail.fr', 'Information', 'Bonjour,  Je voudrais créer une recette comment faire ?'),
(3, 'Philippe', 'Philippe', 'david.alfaro@hotmail.fr', 'Question', 'Bonjour, Allez-vous instaurer les recettes du Kenya ?'),
(4, 'O\'shea', 'Terry', 'david.alfaro@hotmail.fr', 'Infos', 'Bonjour, peut-on créer une recette déjà existante ?'),
(5, 'Guilherme', 'Savio', 'crazy_latino@hotmail.fr', 'Information', 'Bonjour, J\'aurai une suggestion à vous faire, il serait bien de pouvoir rajouter quelques ingrédients.'),
(6, 'Durand', 'Edouard', 'david.alfaro@hotmail.fr', 'Gaspacho', 'Bonjour, serait-il possible de vous faire part d\'une suggestion par rapport à la recette Gaspacho?'),
(7, 'Henry', 'Charles', 'crazy_latino@hotmail.fr', 'Recette indienne', 'Bonjour,serait-il possible d\'ajouter les cuisines indiennes?'),
(8, 'Hakoun', 'Hakim', 'david.alfaro@hotmail.fr', 'Infos', 'Comment faire pour contribuer à votre site ?'),
(9, 'Henry', 'Thierry', 'test@gmail.com', 'Infomation', 'Bonjour, peut-on créer une recette ?'),
(10, 'Craoi', 'Romani', 'crazy_latino@hotmail.fr', 'Informartion', 'Bonjour, serait-il possible de mettre des recettes roumaines?'),
(11, 'hackeur', 'jean', 'harnaque@gmail.com', 'test', '<script>alert(\'coucou\');</script>');

-- --------------------------------------------------------

--
-- Structure de la table `cooking_recipe`
--

CREATE TABLE `cooking_recipe` (
  `id` int(11) NOT NULL,
  `specialty_country_id` int(11) NOT NULL,
  `part_of_menu_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preparation_time` int(11) NOT NULL,
  `cooking_time` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  `published` tinyint(1) NOT NULL,
  `nb_visit` int(11) NOT NULL,
  `average_note` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cooking_recipe`
--

INSERT INTO `cooking_recipe` (`id`, `specialty_country_id`, `part_of_menu_id`, `image_id`, `user_id`, `name`, `slug`, `preparation_time`, `cooking_time`, `content`, `date_creation`, `published`, `nb_visit`, `average_note`) VALUES
(1, 1, 3, 39, 3, 'Gaspacho', 'gaspacho', 15, 15, 'Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.\r\n\r\nEt eodem impetu Domitianum praecipitem per scalas itidem funibus constrinxerunt, eosque coniunctos per ampla spatia civitatis acri raptavere discursu. iamque artuum et membrorum divulsa conpage superscandentes corpora mortuorum ad ultimam truncata deformitatem velut exsaturati mox abiecerunt in flumen.\r\n\r\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\r\n\r\nPostremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.\r\n\r\nUtque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.', '2017-11-04 17:50:44', 1, 12, 3.5),
(2, 8, 4, 77, 3, 'Fajitas', 'fajitas', 30, 45, 'blablabla', '2017-11-08 15:23:01', 1, 15, 3.4),
(3, 4, 5, 78, 3, 'Cookie', 'cookie', 20, 20, 'blablablablabla', '2017-11-08 15:46:32', 1, 8, NULL),
(4, 3, 4, 79, 3, 'Paella', 'paella', 120, 60, 'blablabla', '2017-11-08 15:59:30', 1, 9, NULL),
(5, 4, 5, 80, 3, 'Milkshake fraise', 'milkshake-fraise', 10, 20, 'blablabla', '2017-11-08 21:21:52', 1, 5, 5),
(6, 6, 4, 81, 3, 'Yakitori', 'yakitori', 5, 15, 'blablabla', '2017-11-08 21:27:01', 1, 5, 4),
(7, 7, 4, 82, 3, 'Couscous marocain', 'couscous-marocain', 120, 120, 'Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.\r\n\r\nEt eodem impetu Domitianum praecipitem per scalas itidem funibus constrinxerunt, eosque coniunctos per ampla spatia civitatis acri raptavere discursu. iamque artuum et membrorum divulsa conpage superscandentes corpora mortuorum ad ultimam truncata deformitatem velut exsaturati mox abiecerunt in flumen.\r\n\r\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\r\n\r\nPostremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.\r\n\r\nUtque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.', '2017-11-09 08:55:12', 1, 4, NULL),
(8, 2, 3, 83, 3, 'Salade landaise', 'salade-landaise', 10, 15, 'Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.\r\n\r\nEt eodem impetu Domitianum praecipitem per scalas itidem funibus constrinxerunt, eosque coniunctos per ampla spatia civitatis acri raptavere discursu. iamque artuum et membrorum divulsa conpage superscandentes corpora mortuorum ad ultimam truncata deformitatem velut exsaturati mox abiecerunt in flumen.\r\n\r\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\r\n\r\nPostremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.\r\n\r\nUtque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.', '2017-11-09 08:58:00', 1, 2, NULL),
(9, 3, 2, 84, 3, 'Tapas espagnol', 'tapas-espagnol', 5, 15, 'Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.\r\n\r\nEt eodem impetu Domitianum praecipitem per scalas itidem funibus constrinxerunt, eosque coniunctos per ampla spatia civitatis acri raptavere discursu. iamque artuum et membrorum divulsa conpage superscandentes corpora mortuorum ad ultimam truncata deformitatem velut exsaturati mox abiecerunt in flumen.\r\n\r\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\r\n\r\nPostremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.\r\n\r\nUtque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam ', '2017-11-09 09:05:00', 1, 3, 4),
(10, 5, 5, 85, 3, 'Jalabi au miel', 'jalabi-au-miel', 20, 15, 'Saraceni tamen nec amici nobis umquam nec hostes optandi, ultro citroque discursantes quicquid inveniri poterat momento temporis parvi vastabant milvorum rapacium similes, qui si praedam dispexerint celsius, volatu rapiunt celeri, aut nisi impetraverint, non inmorantur.\r\n\r\nEt eodem impetu Domitianum praecipitem per scalas itidem funibus constrinxerunt, eosque coniunctos per ampla spatia civitatis acri raptavere discursu. iamque artuum et membrorum divulsa conpage superscandentes corpora mortuorum ad ultimam truncata deformitatem velut exsaturati mox abiecerunt in flumen.\r\n\r\nMox dicta finierat, multitudo omnis ad, quae imperator voluit, promptior laudato consilio consensit in pacem ea ratione maxime percita, quod norat expeditionibus crebris fortunam eius in malis tantum civilibus vigilasse, cum autem bella moverentur externa, accidisse plerumque luctuosa, icto post haec foedere gentium ritu perfectaque sollemnitate imperator Mediolanum ad hiberna discessit.\r\n\r\nPostremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.\r\n\r\nUtque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.', '2017-11-09 09:09:14', 1, 1, NULL),
(11, 1, 4, 86, 3, 'Pizza roquette et parmesan', 'pizza-roquette-et-parmesan', 30, 20, 'Orientis vero limes in longum protentus et rectum ab Euphratis fluminis ripis ad usque supercilia porrigitur Nili, laeva Saracenis conterminans gentibus, dextra pelagi fragoribus patens, quam plagam Nicator Seleucus occupatam auxit magnum in modum, cum post Alexandri Macedonis obitum successorio iure teneret regna Persidis, efficaciae inpetrabilis rex, ut indicat cognomentum.\r\n\r\nVerum ad istam omnem orationem brevis est defensio. Nam quoad aetas M. Caeli dare potuit isti suspicioni locum, fuit primum ipsius pudore, deinde etiam patris diligentia disciplinaque munita. Qui ut huic virilem togam deditšnihil dicam hoc loco de me; tantum sit, quantum vos existimatis; hoc dicam, hunc a patre continuo ad me esse deductum; nemo hunc M. Caelium in illo aetatis flore vidit nisi aut cum patre aut mecum aut in M. Crassi castissima domo, cum artibus honestissimis erudiretur.\r\n\r\nEt hanc quidem praeter oppida multa duae civitates exornant Seleucia opus Seleuci regis, et Claudiopolis quam deduxit coloniam Claudius Caesar. Isaura enim antehac nimium potens, olim subversa ut rebellatrix interneciva aegre vestigia claritudinis pristinae monstrat admodum pauca.\r\n\r\nOb haec et huius modi multa, quae cernebantur in paucis, omnibus timeri sunt coepta. et ne tot malis dissimulatis paulatimque serpentibus acervi crescerent aerumnarum, nobilitatis decreto legati mittuntur: Praetextatus ex urbi praefecto et ex vicario Venustus et ex consulari Minervius oraturi, ne delictis supplicia sint grandiora, neve senator quisquam inusitato et inlicito more tormentis exponeretur.', '2017-11-24 10:29:54', 1, 4, NULL),
(12, 2, 4, 89, 3, 'Poulet basquaise', 'poulet-basquaise', 30, 60, 'Adolescebat autem obstinatum propositum erga haec et similia multa scrutanda, stimulos admovente regina, quae abrupte mariti fortunas trudebat in exitium praeceps, cum eum potius lenitate feminea ad veritatis humanitatisque viam reducere utilia suadendo deberet, ut in Gordianorum actibus factitasse Maximini truculenti illius imperatoris rettulimus coniugem.\r\n\r\nApud has gentes, quarum exordiens initium ab Assyriis ad Nili cataractas porrigitur et confinia Blemmyarum, omnes pari sorte sunt bellatores seminudi coloratis sagulis pube tenus amicti, equorum adiumento pernicium graciliumque camelorum per diversa se raptantes, in tranquillis vel turbidis rebus: nec eorum quisquam aliquando stivam adprehendit vel arborem colit aut arva subigendo quaeritat victum, sed errant semper per spatia longe lateque distenta sine lare sine sedibus fixis aut legibus: nec idem perferunt diutius caelum aut tractus unius soli illis umquam placet.\r\n\r\nQuod si rectum statuerimus vel concedere amicis, quidquid velint, vel impetrare ab iis, quidquid velimus, perfecta quidem sapientia si simus, nihil habeat res vitii; sed loquimur de iis amicis qui ante oculos sunt, quos vidimus aut de quibus memoriam accepimus, quos novit vita communis. Ex hoc numero nobis exempla sumenda sunt, et eorum quidem maxime qui ad sapientiam proxime accedunt.', '2017-12-03 16:41:15', 1, 2, NULL),
(13, 9, 4, 90, 6, 'Soupe thai poulet et coco', 'soupe-thai-poulet-coco', 15, 45, 'Denique Antiochensis ordinis vertices sub uno elogio iussit occidi ideo efferatus, quod ei celebrari vilitatem intempestivam urgenti, cum inpenderet inopia, gravius rationabili responderunt; et perissent ad unum ni comes orientis tunc Honoratus fixa constantia restitiss\r\n\r\nQuam ob rem circumspecta cautela observatum est deinceps et cum edita montium petere coeperint grassatores, loci iniquitati milites cedunt. ubi autem in planitie potuerint reperiri, quod contingit adsidue, nec exsertare lacertos nec crispare permissi tela, quae vehunt bina vel terna, pecudum ritu inertium trucidantur.\r\n\r\nSed si ille hac tam eximia fortuna propter utilitatem rei publicae frui non properat, ut omnia illa conficiat, quid ego, senator, facere debeo, quem, etiamsi ille aliud vellet, rei publicae consulere oporteret?', '2017-12-04 10:54:54', 1, 2, NULL),
(14, 10, 6, 96, 3, 'Caipirinha', 'caipirinha', 5, 0, 'Cyprum itidem insulam procul a continenti discretam et portuosam inter municipia crebra urbes duae faciunt claram Salamis et Paphus, altera Iovis delubris altera Veneris templo insignis. tanta autem tamque multiplici fertilitate abundat rerum omnium eadem Cyprus ut nullius externi indigens adminiculi indigenis viribus a fundamento ipso carinae ad supremos usque carbasos aedificet onerariam navem omnibusque armamentis instructam mari committat.\r\n\r\nEt olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina suscipitur et regina et ubique patrum reverenda cum auctoritate canities populique Romani nomen circumspectum et verecundum.\r\n\r\nArdeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum C. Caesare reducit, reconciliat, restituit in gratiam.', '2017-12-05 14:45:35', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cooking_recipe_ingredient`
--

CREATE TABLE `cooking_recipe_ingredient` (
  `cooking_recipe_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cooking_recipe_ingredient`
--

INSERT INTO `cooking_recipe_ingredient` (`cooking_recipe_id`, `ingredient_id`) VALUES
(1, 5),
(1, 7),
(2, 7),
(2, 18),
(2, 25),
(2, 46),
(2, 48),
(3, 25),
(3, 43),
(3, 50),
(4, 14),
(4, 18),
(4, 22),
(4, 32),
(4, 35),
(4, 36),
(4, 37),
(4, 48),
(5, 27),
(5, 44),
(5, 50),
(6, 12),
(7, 1),
(7, 2),
(7, 4),
(7, 18),
(7, 23),
(7, 36),
(7, 37),
(8, 7),
(8, 21),
(8, 35),
(8, 36),
(8, 48),
(9, 7),
(9, 48),
(10, 25),
(10, 37),
(10, 48),
(10, 50),
(11, 4),
(11, 7),
(11, 39),
(12, 4),
(12, 5),
(12, 7),
(12, 18),
(12, 35),
(12, 36),
(12, 48),
(13, 7),
(14, 50),
(14, 51);

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(2, 'Pierre.A', 'pierre.a', 'pierrea@yahoo.fr', 'pierrea@yahoo.fr', 1, NULL, '$2y$13$9liRiOWZrddQXQ7OxWtxzOp/P3h1TLa8sUGOUYOzSxG4YMblJnSzu', NULL, NULL, NULL, 'a:0:{}'),
(3, 'D.Alfaro.chiva', 'd.alfaro.chiva', 'david.alfaro.chiva@gmail.com', 'david.alfaro.chiva@gmail.com', 1, NULL, '$2y$13$y22g4jH6qSQqXxR44h9XRu/p1q0lCTvjPRrZ.uEufNdTKwfA9OaDq', '2017-12-11 02:07:52', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(4, 'Durand.J.P', 'durand.j.p', 'durandjp@test.fr', 'durandjp@test.fr', 1, NULL, '$2y$13$rHYsE9M9UVywQjHahvqHxe.hPoDVMjjOWZTdYAWlaQasdkJuXWNKG', '2017-12-03 18:17:44', NULL, NULL, 'a:0:{}'),
(5, 'Thauvin.F', 'thauvin.f', 'thauvinF@test.com', 'thauvinf@test.com', 1, NULL, '$2y$13$wqQOR8I/X7iLKhebY2u5luooJtcGraaWG/4HZqG4RECfJWjwlMj1i', '2017-12-03 18:18:53', NULL, NULL, 'a:0:{}'),
(6, 'Henry.P', 'henry.p', 'henryp@test.fr', 'henryp@test.fr', 0, NULL, '$2y$13$51y6XQwAXk3/cdKkpf3zlO/Jd/WHOz3ScnZ.u8cTpdWmqyS5eU/n2', '2017-12-04 15:56:59', NULL, NULL, 'a:0:{}'),
(7, 'Gurini.I', 'gurini.i', 'guriniI@test.com', 'gurinii@test.com', 1, NULL, '$2y$13$yHpnxMrUSHAahzL/KjrllODYAr4018SsOe2A3PgV7Z/9M76lpBxG6', '2017-12-03 18:22:57', NULL, NULL, 'a:0:{}'),
(8, 'Philos.B', 'philos.b', 'philosb@test.fr', 'philosb@test.fr', 1, NULL, '$2y$13$4xkjZ27z52uefMZA94iwD.zrsyL80AqB5eTI9nk6hk3E84kPvR912', '2017-12-11 10:55:34', NULL, NULL, 'a:0:{}'),
(9, 'czede', 'czede', 'h@j.gf', 'h@j.gf', 1, NULL, '$2y$13$G8tDAJk/Axu02167.8iUt.6K5DozOAqn6lu750mmZFb6gY09G8wXW', '2017-12-10 23:15:21', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `url`, `alt`) VALUES
(1, 'categorie-legumes.jpg', 'categorie-legumes.jpg'),
(2, '2-divers-poissons.jpg', '2-divers-poissons.jpg'),
(3, 'diverse-viandes.jpg', 'Catégorie viande'),
(4, 'categorie-feculent.jpg', 'Catégorie féculent'),
(5, 'categorie-fruit.jpg', 'Catégorie fruit'),
(6, 'categorie-epice.jpg', 'Catégorie épice'),
(7, 'categorie-herbe-aromatique.jpg', 'Catégorie herbe aromatique'),
(8, 'categorie-produit-laitier.jpg', 'Catégorie produit laitier'),
(9, 'categorie-huile-alimentaire.jpg', 'Catégorie huile alimentaire'),
(10, 'categorie-aperitif.jpg', 'categorie-aperitif.jpg'),
(11, 'type-menu-entree.jpg', 'Menu entrée'),
(12, 'type-menu-plat.jpg', 'Menu plat '),
(13, 'type-menu-dessert.jpg', 'Menu dessert'),
(14, 'recette-Italie.jpg', 'Recette italienne'),
(15, 'recette-france.jpg', 'Les recettes française'),
(16, 'recette-espagne.jpg', 'Les recettes espagnoles'),
(17, 'recette-usa.jpg', 'Les recettes américaine'),
(18, 'recette-inde.jpg', 'Les recettes indiennes'),
(19, 'recette-japon.jpg', 'Les recettes japonaises'),
(20, 'recette-maroc.jpg', 'Les recettes marocaines'),
(21, 'recette-mexique.jpg', 'Mexique'),
(22, 'recette-thai.jpg', 'Les recettes Thai'),
(23, 'legume-courgette.jpg', 'Légume : courgette'),
(24, 'legume-carotte.jpg', 'Légume : carotte'),
(25, 'legume-aubergine.jpg', 'Légume : Aubergine'),
(26, 'legume-oignon.jpg', 'Légume : oignon'),
(27, 'legume-ail.jpg', 'Légume : ail'),
(28, 'legume-champignon.jpg', 'Légume : champignon'),
(29, 'legume-petit-pois.jpg', 'Légume : petit pois'),
(30, 'legume-tomate.jpg', 'Légume : tomate'),
(31, 'legume-asperge.jpg', 'Légume : asperge'),
(32, 'poisson-raie.jpg', 'Poisson : raie'),
(33, 'poisson-lotte.jpg', 'Poisson : lotte'),
(34, 'poisson-turbot.jpg', 'Poisson : turbo'),
(35, 'poisson-saumon.jpg', 'Poisson : saumon'),
(36, 'poisson-thon.jpg', 'Poisson : thon'),
(37, 'poisson-limande.jpg', 'Poisson : limande'),
(38, 'poisson-daurade-royale.jpg', 'Poisson : daurade royale'),
(39, 'gaspacho.jpeg', 'Entrée italien gaspacho'),
(40, 'viande-boeuf.jpg', 'Viande boeuf'),
(41, 'viande-poulet.jpg', 'Viande poulet'),
(42, 'viande-veau.jpg', 'Viande veau'),
(43, 'viande-agneau.jpg', 'Viande agneau'),
(45, 'viande-canard.jpg', 'Viande canard'),
(46, 'feculent-riz.jpg', 'Féculent riz'),
(47, 'feculent-pate.jpg', 'Féculent pâte'),
(48, 'feculent-semoule.jpg', 'Féculent semoule'),
(49, 'feculent-pomme-de-terre.jpg', 'Féculent pomme de terre'),
(50, 'feculent-farine-de-ble.jpg', 'Féculent farine de blé'),
(51, 'feculent-haricot-rouge.jpg', 'feculent-haricot-rouge.jpg'),
(52, 'fruit-fraise.jpg', 'fruit fraise'),
(53, 'fruit-pomme.jpg', 'Fruit pomme'),
(54, 'fruit-poire.jpg', 'Fruit poire'),
(55, 'fruit-banane.jpg', 'Fruit banane'),
(56, 'fruit-framboise.jpg', 'Fruit framboise'),
(57, 'epice-curcuma.jpg', 'Epice curcuma'),
(58, 'epice-curry.jpg', ''),
(59, 'epice-cannelle.jpg', 'Epice cannelle'),
(60, 'epice-poivre.jpg', 'Epice poivre'),
(61, 'epice-sel.jpg', 'Epice sel'),
(62, 'epice-safran.jpg', 'Epice safran'),
(63, 'plante-aromatique-thym.jpg', 'Plante aromatique thym'),
(64, 'plante-aromatique-basilic.jpg', 'Plante aromatique basilic'),
(65, 'plante-aromatique-menthe.jpg', 'Plante aromatique menthe'),
(66, 'plante-aromatique-origan.jpg', 'Plante aromatique origan'),
(67, 'plante-aromatique-romarin.jpg', 'Plante aromatique romarin'),
(68, 'produit-laitier-beurre.jpg', 'Produit laitier beurre'),
(69, 'produit-laitier-lait.jpg', 'Produit laitier lait'),
(70, 'produit-laitier-creme-fraiche.jpg', 'Produit laitier creme fraiche'),
(71, 'produit-laitier-cheddar.jpg', 'Produit laitier cheddar'),
(72, 'produit-laitier-gruyere.jpg', 'Produit laitier gruyere'),
(73, 'huile-alimentaire-huile-olive.jpg', 'Huile alimentaire huile d\'olive'),
(74, 'huile-alimentaire-huile-colza.jpg', 'Huile alimentaire huile de colza'),
(75, 'categorie-patisserie.jpg', 'Catégorie patisserie'),
(76, 'patisserie-sucre.jpg', 'Patisserie sucre'),
(77, 'fajitas-poulet.jpg', 'fajitas-poulet.jpg'),
(78, 'cookie-chocolat.jpg', 'cookie-chocolat.jpg'),
(79, 'paella.jpg', 'paella.jpg'),
(80, 'milk-shake-fraise-dessert.jpg', 'milk-shake-fraise-dessert.jpg'),
(81, 'yakitori-saumon-japon.jpg', 'yakitori-saumon-japon.jpg'),
(82, 'cuisine-marocaine-couscous-poulet-merguez.jpg', 'cuisine-marocaine-couscous-poulet-merguez.jpg'),
(83, 'cuisine-francaise-salade-landaise-canard.jpg', 'cuisine-francaise-salade-landaise-canard.jpg'),
(84, 'cuisine-espagnol-aperitif-tapas.jpg', 'cuisine-espagnol-aperitif-tapas.jpg'),
(85, 'dessert-indien-jalabi-doux.jpg', 'dessert-indien-jalabi-doux.jpg'),
(86, 'pizza-roquette-parmesan.jpg', 'pizza-roquette-parmesan.jpg'),
(89, 'poulet-basquaise.jpg', 'poulet-basquaise.jpg'),
(90, 'soupe-poulet-thai-coco.jpg', 'soupe-poulet-thai-coco.jpg'),
(91, 'specialite-bresil.jpg', 'specialite-bresil.jpg'),
(92, 'type-plat-boisson.jpg', 'type-plat-boisson.jpg'),
(93, 'categorie-alcool.jpg', 'categorie-alcool.jpg'),
(94, 'boisson-cachaca-bresil.jpg', 'boisson-cachaca-bresil.jpg'),
(95, 'fruit-citron-vert.jpg', 'fruit-citron-vert.jpg'),
(96, 'caipirinha-cachaça-cocktail-bresil.jpg', 'caipirinha-cachaça-cocktail-bresil.jpg'),
(97, 'autre-categorie.jpg', 'autre-categorie.jpg'),
(98, 'autre-categorie.jpg', 'autre-categorie.jpg'),
(99, 'autre-categorie.jpg', 'autre-categorie.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `image_id`, `category_id`, `name`, `slug`) VALUES
(1, 23, 1, 'Courgette', 'courgette'),
(2, 24, 1, 'Carotte', 'carotte'),
(3, 25, 1, 'Aubergine', 'aubergine'),
(4, 26, 1, 'Oignon', 'oignon'),
(5, 27, 1, 'Ail', 'ail'),
(6, 29, 1, 'Petit pois', 'petit-pois'),
(7, 30, 1, 'Tomate', 'tomate'),
(8, 31, 1, 'Asperge', 'asperge'),
(9, 32, 2, 'Raie', 'raie'),
(10, 33, 2, 'Lotte', 'lotte'),
(11, 34, 2, 'Turbot', 'turbot'),
(12, 35, 2, 'Saumon', 'saumon'),
(13, 36, 2, 'Thon', 'thon'),
(14, 37, 2, 'Limande', 'limande'),
(15, 38, 2, 'Daurade Royale', 'daurade-royale'),
(16, 40, 3, 'Boeuf', 'boeuf'),
(17, 41, 3, 'Poulet', 'poulet'),
(18, 42, 3, 'Veau', 'veau'),
(19, 43, 3, 'Agneau', 'agneau'),
(20, 45, 3, 'Canard', 'canard'),
(21, 46, 4, 'Riz', 'riz'),
(22, 48, 4, 'Semoule', 'semoule'),
(23, 49, 4, 'Pomme de terre', 'pomme-de-terre'),
(24, 50, 4, 'farine de blé', 'farine-de-ble'),
(25, 51, 4, 'Haricot rouge', 'haricot-rouge'),
(26, 52, 5, 'Fraise', 'fraise'),
(27, 53, 5, 'Pomme', 'pomme'),
(28, 54, 5, 'Poire', 'poire'),
(29, 55, 5, 'Banane', 'banane'),
(30, 56, 5, 'Framboise', 'framboise'),
(31, 57, 6, 'Curcuma', 'curcuma'),
(32, 58, 6, 'Curry', 'curry'),
(33, 59, 6, 'Cannelle', 'cannelle'),
(34, 60, 6, 'Poivre', 'poivre'),
(35, 61, 6, 'Sel', 'sel'),
(36, 62, 6, 'Safran', 'safran'),
(37, 63, 7, 'Thym', 'thym'),
(38, 64, 7, 'Basilic', 'basilic'),
(39, 65, 7, 'Menthe', 'menthe'),
(40, 66, 7, 'Origan', 'origan'),
(41, 67, 7, 'Romarin', 'romarin'),
(42, 68, 8, 'Beurre', 'beurre'),
(43, 69, 8, 'Lait', 'lait'),
(44, 70, 8, 'Crème fraiche', 'creme-fraiche'),
(45, 71, 8, 'Cheddar', 'cheddar'),
(46, 72, 8, 'Gruyére', 'gruyere'),
(47, 73, 9, 'Huile d\'olive', 'huile-olive'),
(48, 74, 9, 'Huile de colza', 'huile-de-colza'),
(49, 76, 10, 'Sucre', 'sucre'),
(50, 94, 11, 'Cachaça', 'cachaca'),
(51, 95, 5, 'Citron vert', 'citron-vert');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_category`
--

CREATE TABLE `ingredient_category` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `ingredient_category`
--

INSERT INTO `ingredient_category` (`id`, `image_id`, `name`, `slug`) VALUES
(1, 1, 'Légume', 'legume'),
(2, 2, 'Poisson', 'poisson'),
(3, 3, 'Viande', 'viande'),
(4, 4, 'Féculent', 'feculent'),
(5, 5, 'Fruit', 'fruit'),
(6, 6, 'Epice', 'epice'),
(7, 7, 'Herbe aromatique', 'herbe-aromatique'),
(8, 8, 'Produit laitier', 'produit-laitier'),
(9, 9, 'Huile alimentaire', 'huile-alimentaire'),
(10, 10, 'Patisserie', 'patisserie'),
(11, 11, 'Alcool', 'alcool'),
(13, 97, 'Autre catégorie', 'autre-categorie');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter_inscription`
--

CREATE TABLE `newsletter_inscription` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `newsletter_inscription`
--

INSERT INTO `newsletter_inscription` (`id`, `mail`) VALUES
(1, 'crazy_latino@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `part_of_menu`
--

CREATE TABLE `part_of_menu` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `part_of_menu`
--

INSERT INTO `part_of_menu` (`id`, `image_id`, `type`, `slug`) VALUES
(2, 10, 'Apéritif', 'aperitif'),
(3, 11, 'Entrée', 'entrée'),
(4, 12, 'Plat', 'plat'),
(5, 13, 'Dessert', 'dessert'),
(6, 92, 'Boisson', 'boisson'),
(7, 99, 'Autre type', 'autre-type');

-- --------------------------------------------------------

--
-- Structure de la table `specialty_country`
--

CREATE TABLE `specialty_country` (
  `id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `specialty_country`
--

INSERT INTO `specialty_country` (`id`, `image_id`, `country`, `slug`) VALUES
(1, 14, 'Italie', 'italie'),
(2, 15, 'France', 'france'),
(3, 16, 'Espagne', 'espagne'),
(4, 17, 'USA', 'usa'),
(5, 18, 'Inde', 'inde'),
(6, 19, 'Japon', 'japon'),
(7, 20, 'Maroc', 'maroc'),
(8, 21, 'Mexique', 'mexique'),
(9, 22, 'Thai', 'thai'),
(10, 91, 'Brésil', 'bresil'),
(11, 98, 'Autre pays', 'autre-pays');

-- --------------------------------------------------------

--
-- Structure de la table `statistic`
--

CREATE TABLE `statistic` (
  `id` int(11) NOT NULL,
  `cooking_recipe_id` int(11) NOT NULL,
  `ip_visitor` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statistic`
--

INSERT INTO `statistic` (`id`, `cooking_recipe_id`, `ip_visitor`) VALUES
(1, 4, '::1'),
(2, 1, '::1'),
(3, 2, '::1'),
(4, 9, '::1'),
(5, 3, '::1'),
(6, 6, '::1'),
(7, 13, '::1'),
(8, 14, '83.156.95.8'),
(9, 4, '78.230.75.61'),
(10, 4, '78.116.170.129'),
(11, 2, '109.129.8.252'),
(12, 9, '81.49.0.9'),
(13, 11, '83.156.95.8'),
(14, 1, '86.213.70.7'),
(15, 2, '78.230.75.61'),
(16, 2, '78.224.185.210'),
(17, 2, '78.252.209.54'),
(18, 1, '78.252.209.54'),
(19, 7, '78.252.209.54'),
(20, 5, '93.26.239.236'),
(21, 6, '93.26.239.236'),
(22, 7, '93.26.239.236'),
(23, 12, '93.26.239.236'),
(24, 3, '92.153.46.195'),
(25, 7, '83.153.93.196'),
(26, 10, '83.156.95.8'),
(27, 13, '88.190.41.10'),
(28, 7, '83.156.95.8'),
(29, 11, '109.0.172.103'),
(30, 6, '83.156.95.8'),
(31, 8, '83.156.95.8'),
(32, 9, '83.156.95.8'),
(33, 1, '77.136.86.125'),
(34, 3, '83.156.95.8'),
(35, 2, '83.156.95.8'),
(36, 1, '178.197.236.199'),
(37, 4, '176.188.159.225'),
(38, 1, '82.239.84.16'),
(39, 1, '86.246.21.66'),
(40, 2, '86.246.21.66'),
(41, 3, '86.246.21.66'),
(42, 4, '86.246.21.66'),
(43, 5, '86.246.21.66'),
(44, 4, '80.215.114.23'),
(45, 2, '82.239.0.158'),
(46, 6, '82.239.0.158'),
(47, 1, '37.169.184.251'),
(48, 6, '37.169.184.251'),
(49, 11, '195.6.5.238'),
(50, 8, '176.170.16.194'),
(51, 1, '37.172.142.218'),
(52, 11, '82.64.0.95'),
(53, 2, '82.226.147.185'),
(54, 3, '78.205.8.177'),
(55, 12, '78.205.8.177'),
(56, 2, '80.15.195.94'),
(57, 4, '80.15.195.94'),
(58, 5, '80.15.195.94'),
(59, 3, '80.15.195.94'),
(60, 1, '80.15.195.94'),
(61, 2, '155.64.38.80'),
(62, 2, '8.28.16.254'),
(63, 2, '185.30.133.97'),
(64, 3, '90.29.56.57'),
(65, 4, '81.57.164.130'),
(66, 2, '81.49.170.67'),
(67, 3, '86.194.240.164'),
(68, 1, '90.29.56.57'),
(69, 2, '88.190.222.183'),
(70, 5, '78.212.90.7'),
(71, 4, '88.190.222.183'),
(72, 2, '78.212.90.7'),
(73, 1, '83.156.95.8'),
(74, 5, '83.156.95.8');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment_recipe`
--
ALTER TABLE `comment_recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_109BE925A76ED395` (`user_id`),
  ADD KEY `IDX_109BE9254D4CA254` (`cooking_recipe_id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cooking_recipe`
--
ALTER TABLE `cooking_recipe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FC1D6BBF5E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_FC1D6BBF989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_FC1D6BBF3DA5256D` (`image_id`),
  ADD KEY `IDX_FC1D6BBFBFA458B1` (`specialty_country_id`),
  ADD KEY `IDX_FC1D6BBF4D79D67` (`part_of_menu_id`),
  ADD KEY `IDX_FC1D6BBFA76ED395` (`user_id`);

--
-- Index pour la table `cooking_recipe_ingredient`
--
ALTER TABLE `cooking_recipe_ingredient`
  ADD PRIMARY KEY (`cooking_recipe_id`,`ingredient_id`),
  ADD KEY `IDX_18DB59E94D4CA254` (`cooking_recipe_id`),
  ADD KEY `IDX_18DB59E9933FE08C` (`ingredient_id`);

--
-- Index pour la table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6BAF78705E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_6BAF7870989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_6BAF78703DA5256D` (`image_id`),
  ADD KEY `IDX_6BAF787012469DE2` (`category_id`);

--
-- Index pour la table `ingredient_category`
--
ALTER TABLE `ingredient_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_744A494F5E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_744A494F989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_744A494F3DA5256D` (`image_id`);

--
-- Index pour la table `newsletter_inscription`
--
ALTER TABLE `newsletter_inscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_687EA9195126AC48` (`mail`);

--
-- Index pour la table `part_of_menu`
--
ALTER TABLE `part_of_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_586145AB8CDE5729` (`type`),
  ADD UNIQUE KEY `UNIQ_586145AB989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_586145AB3DA5256D` (`image_id`);

--
-- Index pour la table `specialty_country`
--
ALTER TABLE `specialty_country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2146D5F95373C966` (`country`),
  ADD UNIQUE KEY `UNIQ_2146D5F9989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_2146D5F93DA5256D` (`image_id`);

--
-- Index pour la table `statistic`
--
ALTER TABLE `statistic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_649B469C4D4CA254` (`cooking_recipe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment_recipe`
--
ALTER TABLE `comment_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `cooking_recipe`
--
ALTER TABLE `cooking_recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `ingredient_category`
--
ALTER TABLE `ingredient_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `newsletter_inscription`
--
ALTER TABLE `newsletter_inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `part_of_menu`
--
ALTER TABLE `part_of_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `specialty_country`
--
ALTER TABLE `specialty_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `statistic`
--
ALTER TABLE `statistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment_recipe`
--
ALTER TABLE `comment_recipe`
  ADD CONSTRAINT `FK_109BE9254D4CA254` FOREIGN KEY (`cooking_recipe_id`) REFERENCES `cooking_recipe` (`id`),
  ADD CONSTRAINT `FK_109BE925A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `cooking_recipe`
--
ALTER TABLE `cooking_recipe`
  ADD CONSTRAINT `FK_FC1D6BBF3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  ADD CONSTRAINT `FK_FC1D6BBF4D79D67` FOREIGN KEY (`part_of_menu_id`) REFERENCES `part_of_menu` (`id`),
  ADD CONSTRAINT `FK_FC1D6BBFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_FC1D6BBFBFA458B1` FOREIGN KEY (`specialty_country_id`) REFERENCES `specialty_country` (`id`);

--
-- Contraintes pour la table `cooking_recipe_ingredient`
--
ALTER TABLE `cooking_recipe_ingredient`
  ADD CONSTRAINT `FK_18DB59E94D4CA254` FOREIGN KEY (`cooking_recipe_id`) REFERENCES `cooking_recipe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_18DB59E9933FE08C` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `FK_6BAF787012469DE2` FOREIGN KEY (`category_id`) REFERENCES `ingredient_category` (`id`),
  ADD CONSTRAINT `FK_6BAF78703DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `ingredient_category`
--
ALTER TABLE `ingredient_category`
  ADD CONSTRAINT `FK_744A494F3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `part_of_menu`
--
ALTER TABLE `part_of_menu`
  ADD CONSTRAINT `FK_586145AB3DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `specialty_country`
--
ALTER TABLE `specialty_country`
  ADD CONSTRAINT `FK_2146D5F93DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`);

--
-- Contraintes pour la table `statistic`
--
ALTER TABLE `statistic`
  ADD CONSTRAINT `FK_649B469C4D4CA254` FOREIGN KEY (`cooking_recipe_id`) REFERENCES `cooking_recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
