-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Mars 2018 à 12:27
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `orh`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE `actualite` (
  `ID_ACT` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `LIB_ACT` varchar(256) NOT NULL,
  `DESC_ACT` text NOT NULL,
  `PATH_IMG_ACT` varchar(256) NOT NULL,
  `DATE_ECRIRE_ACT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `NOM_ADMIN` varchar(256) NOT NULL,
  `PRENOM_ADMIN` varchar(256) NOT NULL,
  `PSEUDO_ADMIN` varchar(256) NOT NULL,
  `MDP_ADMIN` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`ID_ADMIN`, `NOM_ADMIN`, `PRENOM_ADMIN`, `PSEUDO_ADMIN`, `MDP_ADMIN`) VALUES
(1, 'F4', 'T2S2', 'f4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `avoir_dom`
--

CREATE TABLE `avoir_dom` (
  `ID_CND` int(11) NOT NULL,
  `ID_DOM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `avoir_dom`
--

INSERT INTO `avoir_dom` (`ID_CND`, `ID_DOM`) VALUES
(27, 24),
(27, 25),
(27, 26),
(28, 28);

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `ID_CND` int(11) NOT NULL,
  `ID_GENRE` int(11) NOT NULL,
  `ID_NIVEAU` int(11) NOT NULL,
  `ID_CONTRAT` int(11) NOT NULL,
  `ID_SIT_PROF` int(11) NOT NULL,
  `ID_SIT_MAT` int(11) NOT NULL,
  `ID_NAT` int(11) NOT NULL,
  `NOM_CND` varchar(256) NOT NULL,
  `PRENOM_CND` varchar(256) NOT NULL,
  `DATE_NAISS_CND` date NOT NULL,
  `CONTACT_CND` varchar(20) NOT NULL,
  `EMAIL_CND` varchar(40) NOT NULL,
  `ANNEE_EXP_CND` int(11) NOT NULL,
  `PATH_PHOTO_CND` varchar(256) NOT NULL,
  `CLE_CND` varchar(256) NOT NULL,
  `ACTIF_CND` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `candidat`
--

INSERT INTO `candidat` (`ID_CND`, `ID_GENRE`, `ID_NIVEAU`, `ID_CONTRAT`, `ID_SIT_PROF`, `ID_SIT_MAT`, `ID_NAT`, `NOM_CND`, `PRENOM_CND`, `DATE_NAISS_CND`, `CONTACT_CND`, `EMAIL_CND`, `ANNEE_EXP_CND`, `PATH_PHOTO_CND`, `CLE_CND`, `ACTIF_CND`) VALUES
(27, 1, 4, 5, 3, 1, 1, 'degni', 'beugré jocelin neymar', '1996-04-18', '59061767', 'degni18@gmail.com', 5, 'f10bc88fdaa03cd7946156178112b109', '9a993f143ebcab452a67d4706b3eea3a', 1),
(28, 1, 4, 3, 4, 5, 1, 'attoube', 'yann cloud', '1998-02-11', '08080808', 'yann@gmail.com', 2, '58a69b445ad3b64f3e24573c86664ba9', '28f2cd4321fa4e1810d0987ddd516bd7', 1);

-- --------------------------------------------------------

--
-- Structure de la table `changer_hab`
--

CREATE TABLE `changer_hab` (
  `ID_ADMIN_SUPER` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `DATE_CHANGE_HAB` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `changer_statut_ent`
--

CREATE TABLE `changer_statut_ent` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_ENT` int(11) NOT NULL,
  `ID_SATUT_ENT` int(11) NOT NULL,
  `DATE_CHANGE_STATUT_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte_admin`
--

CREATE TABLE `compte_admin` (
  `ID_COMPTE_ADMIN` int(11) NOT NULL,
  `MDP_COMPTE_ADMIN` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `compte_cnd`
--

CREATE TABLE `compte_cnd` (
  `ID_COMPTE_CND` int(11) NOT NULL,
  `MDP_COMPTE_CND` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte_cnd`
--

INSERT INTO `compte_cnd` (`ID_COMPTE_CND`, `MDP_COMPTE_CND`) VALUES
(16, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(17, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(18, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(19, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(20, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(21, '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `compte_ent`
--

CREATE TABLE `compte_ent` (
  `ID_COMPTE_ENT` int(11) NOT NULL,
  `MDP_COMPTE_ENT` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte_ent`
--

INSERT INTO `compte_ent` (`ID_COMPTE_ENT`, `MDP_COMPTE_ENT`) VALUES
(19, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(20, '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(21, '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Structure de la table `connexion_admin`
--

CREATE TABLE `connexion_admin` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_COMPTE_ADMIN` int(11) NOT NULL,
  `DATE_CONN_ADMIN` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `connexion_cnd`
--

CREATE TABLE `connexion_cnd` (
  `ID_CND` int(11) NOT NULL,
  `ID_COMPTE_CND` int(11) NOT NULL,
  `DATE_CONN_CND` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `connexion_cnd`
--

INSERT INTO `connexion_cnd` (`ID_CND`, `ID_COMPTE_CND`, `DATE_CONN_CND`) VALUES
(27, 20, '2018-02-18 12:33:57'),
(27, 20, '2018-02-20 17:39:19'),
(27, 20, '2018-02-20 17:43:16'),
(27, 20, '2018-02-23 10:37:05'),
(27, 20, '2018-02-25 00:12:05'),
(27, 20, '2018-03-08 10:57:19'),
(28, 21, '2018-02-23 12:14:24'),
(28, 21, '2018-02-23 18:34:51');

-- --------------------------------------------------------

--
-- Structure de la table `connexion_ent`
--

CREATE TABLE `connexion_ent` (
  `ID_ENT` int(11) NOT NULL,
  `ID_COMPTE_ENT` int(11) NOT NULL,
  `DATE_CONN_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `connexion_ent`
--

INSERT INTO `connexion_ent` (`ID_ENT`, `ID_COMPTE_ENT`, `DATE_CONN_ENT`) VALUES
(23, 19, '2018-02-05 01:31:45'),
(23, 19, '2018-02-05 13:38:57'),
(24, 20, '2018-02-05 13:44:52'),
(24, 20, '2018-02-05 14:38:09'),
(24, 20, '2018-02-05 14:51:12'),
(24, 20, '2018-02-11 15:59:50'),
(24, 20, '2018-02-12 18:59:00'),
(24, 20, '2018-02-14 18:44:58'),
(24, 20, '2018-02-24 23:02:15'),
(24, 20, '2018-02-25 00:25:37'),
(24, 20, '2018-02-25 02:37:27'),
(25, 21, '2018-03-03 20:45:34'),
(24, 20, '2018-03-08 10:59:30');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `ID_CONTRAT` int(11) NOT NULL,
  `LIB_CONTRAT` varchar(256) NOT NULL,
  `DESC_CONTRAT` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contrat`
--

INSERT INTO `contrat` (`ID_CONTRAT`, `LIB_CONTRAT`, `DESC_CONTRAT`) VALUES
(1, 'CDD', ''),
(2, 'CDI', ''),
(3, 'Intérim', ''),
(4, 'Autre', ''),
(5, 'Stage', '');

-- --------------------------------------------------------

--
-- Structure de la table `creer_compte_cnd`
--

CREATE TABLE `creer_compte_cnd` (
  `ID_CND` int(11) NOT NULL,
  `ID_COMPTE_CND` int(11) NOT NULL,
  `DATE_CREE_COMPTE_CND` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `creer_compte_cnd`
--

INSERT INTO `creer_compte_cnd` (`ID_CND`, `ID_COMPTE_CND`, `DATE_CREE_COMPTE_CND`) VALUES
(27, 20, '2018-02-18 12:33:01'),
(28, 21, '2018-02-23 12:11:13');

-- --------------------------------------------------------

--
-- Structure de la table `creer_compte_ent`
--

CREATE TABLE `creer_compte_ent` (
  `ID_ENT` int(11) NOT NULL,
  `ID_COMPTE_ENT` int(11) NOT NULL,
  `DATE_CREE_COMPTE_ENT` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `creer_compte_ent`
--

INSERT INTO `creer_compte_ent` (`ID_ENT`, `ID_COMPTE_ENT`, `DATE_CREE_COMPTE_ENT`) VALUES
(24, 20, '2018-02-05 13:38:40'),
(25, 21, '2018-03-03 20:37:08');

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE `cv` (
  `ID_CV` int(11) NOT NULL,
  `ID_CND` int(11) NOT NULL,
  `LIB_CV` varchar(256) NOT NULL,
  `DATE_MODIF_CV` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cv`
--

INSERT INTO `cv` (`ID_CV`, `ID_CND`, `LIB_CV`, `DATE_MODIF_CV`) VALUES
(1, 27, '98735798babd7a841605ee9da2259123', '2018-03-08 10:57:42'),
(2, 28, 'b5c36a528b51a0205d3fcaca1bcda3a6', '2018-02-23 12:28:28');

-- --------------------------------------------------------

--
-- Structure de la table `domaine_comp`
--

CREATE TABLE `domaine_comp` (
  `ID_DOM` int(11) NOT NULL,
  `LIB_DOM` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `domaine_comp`
--

INSERT INTO `domaine_comp` (`ID_DOM`, `LIB_DOM`) VALUES
(24, 'Déclarant en douane / Déclarante en douane'),
(25, 'Décorateur scénographe / Décoratrice scénographe'),
(26, 'Démographe'),
(27, 'Designer industriel'),
(28, 'Directeur administratif et financier'),
(29, 'Directeur artistique / Directrice artistique'),
(30, 'Directeur d\'hôtel'),
(31, 'Directeur de la photographie'),
(32, 'Directeur des ressources humaines'),
(33, 'Directeur informatique'),
(34, 'Documentaliste');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID_ENT` int(11) NOT NULL,
  `ID_INTER` int(11) NOT NULL,
  `ID_TYPE_SOC` int(11) NOT NULL,
  `ID_FORM_JUR` int(11) NOT NULL,
  `ID_STATUT_ENT` int(11) NOT NULL,
  `SIGLE_ENT` varchar(100) NOT NULL,
  `EMAIL_ENT` varchar(30) NOT NULL,
  `RAISON_SOCIALE_ENT` text NOT NULL,
  `COMPTE_CONTRIB_ENT` varchar(50) NOT NULL,
  `REG_COM_ENT` varchar(50) NOT NULL,
  `TEL_ENT` varchar(20) NOT NULL,
  `ADRESSE_POST_ENT` varchar(30) NOT NULL,
  `SITE_ENT` varchar(30) DEFAULT NULL,
  `FAX_ENT` varchar(30) DEFAULT NULL,
  `PATH_LOGO_ENT` varchar(256) NOT NULL,
  `CLE_ENT` varchar(256) NOT NULL,
  `ACTIF_ENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`ID_ENT`, `ID_INTER`, `ID_TYPE_SOC`, `ID_FORM_JUR`, `ID_STATUT_ENT`, `SIGLE_ENT`, `EMAIL_ENT`, `RAISON_SOCIALE_ENT`, `COMPTE_CONTRIB_ENT`, `REG_COM_ENT`, `TEL_ENT`, `ADRESSE_POST_ENT`, `SITE_ENT`, `FAX_ENT`, `PATH_LOGO_ENT`, `CLE_ENT`, `ACTIF_ENT`) VALUES
(24, 53, 1, 3, 1, 'ANDROID', 'android@gmail.com', 'Android veut changer la vision du mobile ', 'compte', 'registre', '59061767', 'postale', 'www.android.com', 'fax', '6e4e5c4fa6be4f126b4d5e93f04f1ee7', '460c77e15b2500af782c202ae6d596a7', 1),
(25, 54, 6, 2, 1, 'ASCOMA', 'ascoma@gmail.com', 'aide', 'COMPTE7415698', 'Ci123321', '+22512369852', '01Bp 1abidjan 123', 'www.ascoma.com', 'fax', '458adc590f458c5a674b66c88bf9f28a', '06554cdd5c5cf9e4d74371637744b922', 1);

-- --------------------------------------------------------

--
-- Structure de la table `forme_juridique`
--

CREATE TABLE `forme_juridique` (
  `ID_FORM_JUR` int(11) NOT NULL,
  `LIB_FORM_JUR` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `forme_juridique`
--

INSERT INTO `forme_juridique` (`ID_FORM_JUR`, `LIB_FORM_JUR`) VALUES
(1, 'SA'),
(2, 'SARL'),
(3, 'Entreprise Individuelle'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `ID_GENRE` int(11) NOT NULL,
  `LIB_GENRE` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`ID_GENRE`, `LIB_GENRE`) VALUES
(1, 'Homme'),
(2, 'Femme');

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

CREATE TABLE `habilitation` (
  `ID_HAB` int(11) NOT NULL,
  `LIB_HAB` varchar(256) NOT NULL,
  `DESC_HAB` int(11) NOT NULL,
  `voir` int(11) NOT NULL,
  `cecrire` int(11) NOT NULL,
  `supp` int(11) NOT NULL,
  `super` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `interlocuteur`
--

CREATE TABLE `interlocuteur` (
  `ID_INTER` int(11) NOT NULL,
  `ID_GENRE` int(11) NOT NULL,
  `NOM_INTER` varchar(256) NOT NULL,
  `PRENOM_INTER` varchar(256) NOT NULL,
  `FONCTION_INTER` varchar(256) NOT NULL,
  `EMAIL_INTER` varchar(40) NOT NULL,
  `TEL_INTER` varchar(20) NOT NULL,
  `PATH_PHOTO_INTER` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `interlocuteur`
--

INSERT INTO `interlocuteur` (`ID_INTER`, `ID_GENRE`, `NOM_INTER`, `PRENOM_INTER`, `FONCTION_INTER`, `EMAIL_INTER`, `TEL_INTER`, `PATH_PHOTO_INTER`) VALUES
(52, 1, 'degni', 'beugre', 'DG', 'degni18@gmail.com', '59061767', 'e448d9145be9e289c7d9d48ecaae0593'),
(53, 1, 'DEGNI', 'jo', 'DG', 'degni18@gmail.com', '59061767', 'default.png'),
(54, 2, 'Kouadio', 'Dominique', 'Secrétaire du DG', 'dominique@gmail.com', '59786321', 'default.png');

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

CREATE TABLE `langue` (
  `ID_LANG` int(11) NOT NULL,
  `LIB_LANG` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `langue`
--

INSERT INTO `langue` (`ID_LANG`, `LIB_LANG`) VALUES
(1, 'Anglais'),
(2, 'Allemand'),
(3, 'Espagnol'),
(4, 'Français');

-- --------------------------------------------------------

--
-- Structure de la table `localiser_cnd`
--

CREATE TABLE `localiser_cnd` (
  `ID_CND` int(11) NOT NULL,
  `ID_PAYS` int(11) NOT NULL,
  `ID_VILLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `localiser_cnd`
--

INSERT INTO `localiser_cnd` (`ID_CND`, `ID_PAYS`, `ID_VILLE`) VALUES
(27, 1, 1),
(28, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `localiser_ent`
--

CREATE TABLE `localiser_ent` (
  `ID_ENT` int(11) NOT NULL,
  `ID_PAYS` int(11) NOT NULL,
  `ID_VILLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `localiser_ent`
--

INSERT INTO `localiser_ent` (`ID_ENT`, `ID_PAYS`, `ID_VILLE`) VALUES
(24, 1, 2),
(25, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `nationnalite`
--

CREATE TABLE `nationnalite` (
  `ID_NAT` int(11) NOT NULL,
  `LIB_NAT` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `nationnalite`
--

INSERT INTO `nationnalite` (`ID_NAT`, `LIB_NAT`) VALUES
(1, 'Ivoirienne - Côte D\'ivoire');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_etude`
--

CREATE TABLE `niveau_etude` (
  `ID_NIVEAU` int(11) NOT NULL,
  `LIB_NIVEAU` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `niveau_etude`
--

INSERT INTO `niveau_etude` (`ID_NIVEAU`, `LIB_NIVEAU`) VALUES
(1, 'BAC+2'),
(2, 'BAC+3'),
(3, 'BAC+4'),
(4, 'BAC+5'),
(5, 'BAC+6'),
(6, 'BAC+7'),
(7, 'BAC+8'),
(8, 'BAC+8 et +'),
(9, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `offre_ent`
--

CREATE TABLE `offre_ent` (
  `ID_OFFRE_ENT` int(11) NOT NULL,
  `ID_ENT` int(11) NOT NULL,
  `PATH_OFFRE_ENT` varchar(256) NOT NULL,
  `DATE_OFFRE_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `offre_ent`
--

INSERT INTO `offre_ent` (`ID_OFFRE_ENT`, `ID_ENT`, `PATH_OFFRE_ENT`, `DATE_OFFRE_ENT`) VALUES
(30, 24, 'a62db7aa8f6591950465adebdafa5ad0', '2018-02-12 19:01:35'),
(33, 24, '2d7890500bb6a92e33f823dc1f9ecd1a', '2018-02-25 02:37:50'),
(34, 25, '00a9ee0c7bd67dc0d8909a678b846455', '2018-03-03 21:22:02'),
(35, 25, '9e42d37707a3975ed1b736272633b1b5', '2018-03-03 21:49:25'),
(36, 24, 'f06f20252034168464d16625f39ce385', '2018-03-08 11:00:53'),
(37, 24, 'a3f15b0689cae08bfd4fcecb717c8fb3', '2018-03-08 11:36:47');

-- --------------------------------------------------------

--
-- Structure de la table `offre_site`
--

CREATE TABLE `offre_site` (
  `ID_OFFRE_SITE` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `OFFRE_SITE` text NOT NULL,
  `DATE_MODIF_OFFRE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DATE_EXPIRATION` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `opere`
--

CREATE TABLE `opere` (
  `ID_ENT` int(11) NOT NULL,
  `ID_SECT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `opere`
--

INSERT INTO `opere` (`ID_ENT`, `ID_SECT`) VALUES
(24, 19),
(24, 25),
(25, 7);

-- --------------------------------------------------------

--
-- Structure de la table `parler`
--

CREATE TABLE `parler` (
  `ID_CND` int(11) NOT NULL,
  `ID_LANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `parler`
--

INSERT INTO `parler` (`ID_CND`, `ID_LANG`) VALUES
(27, 1),
(27, 2),
(27, 4),
(28, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `ID_PAYS` int(11) NOT NULL,
  `LIB_PAYS` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`ID_PAYS`, `LIB_PAYS`) VALUES
(1, 'Côte D\'ivoire');

-- --------------------------------------------------------

--
-- Structure de la table `secteur_act`
--

CREATE TABLE `secteur_act` (
  `ID_SECT` int(11) NOT NULL,
  `LIB_SECT` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `secteur_act`
--

INSERT INTO `secteur_act` (`ID_SECT`, `LIB_SECT`) VALUES
(1, 'Achat / Logistique / Transport \r\n'),
(2, 'Administration - Secrétariat/ Services publics'),
(3, '\r\nAgriculture\r\n'),
(4, 'Association / ONG'),
(5, '\r\nAudit et Conseil\r\n'),
(6, 'Automobile'),
(7, 'Banque / Assurances/Finances'),
(8, 'BTP / Architecture'),
(9, 'Commerces et services de proximité'),
(10, 'Commercial / Vente/ Distribution'),
(11, 'Communication / Marketing / Relations publiques / Publicité'),
(12, 'Direction Générale'),
(13, 'Education / Formation / Animation'),
(14, 'Environnement / Assainissement / Recyclage'),
(15, 'Gestion / Comptabilité / Finance / Fiscalité'),
(16, 'Hôtellerie / Restauration / Tourisme'),
(17, 'Tout Corps de Métiers  en Matière de Construction'),
(18, 'Industrie / Production/ Mines'),
(19, 'Informatique / Télécom'),
(20, 'Juridique'),
(21, 'Multimédia/ Loisirs'),
(22, 'Recherche et Développement'),
(23, 'Ressources Humaines'),
(24, 'Santé / Social'),
(25, 'Sécurité Surveillance et Gardiennage'),
(26, 'Certification');

-- --------------------------------------------------------

--
-- Structure de la table `service_cnd`
--

CREATE TABLE `service_cnd` (
  `ID_SERV_CND` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `LIB_SERV_CND` varchar(256) NOT NULL,
  `DESC_SERV_CND` text NOT NULL,
  `DATE_SERV_CND` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `service_ent`
--

CREATE TABLE `service_ent` (
  `ID_SERV_ENT` int(11) NOT NULL,
  `ID_ADMIN` int(11) NOT NULL,
  `LIB_SERV_ENT` varchar(256) NOT NULL,
  `DESC_SERV_ENT` text NOT NULL,
  `DATE_SERV_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sit_matrimoniale`
--

CREATE TABLE `sit_matrimoniale` (
  `ID_SIT_MAT` int(11) NOT NULL,
  `LIB_SIT_MAT` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sit_matrimoniale`
--

INSERT INTO `sit_matrimoniale` (`ID_SIT_MAT`, `LIB_SIT_MAT`) VALUES
(1, 'Célibataire'),
(2, 'Marié(e)'),
(3, 'Divorcé(e)'),
(4, 'Veuf(ve)'),
(5, 'Concubin(e)');

-- --------------------------------------------------------

--
-- Structure de la table `sit_professionnelle`
--

CREATE TABLE `sit_professionnelle` (
  `ID_SIT_PROF` int(11) NOT NULL,
  `LIB_SIT_PROF` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sit_professionnelle`
--

INSERT INTO `sit_professionnelle` (`ID_SIT_PROF`, `LIB_SIT_PROF`) VALUES
(1, 'Stagiaire'),
(2, 'Sans emploi'),
(3, 'En quête d\'une première expérience'),
(4, 'Indépendant'),
(5, 'Salarié');

-- --------------------------------------------------------

--
-- Structure de la table `souscrire_cnd`
--

CREATE TABLE `souscrire_cnd` (
  `ID_CND` int(11) NOT NULL,
  `ID_SERV_CND` int(11) NOT NULL,
  `DATE_SOUSCRIRE_CND` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `souscrire_ent`
--

CREATE TABLE `souscrire_ent` (
  `ID_ENT` int(11) NOT NULL,
  `ID_SERV_ENT` int(11) NOT NULL,
  `DATE_SOUSCRIRE_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut_ent`
--

CREATE TABLE `statut_ent` (
  `ID_STATUT_ENT` int(11) NOT NULL,
  `LIB_STATUT_ENT` varchar(256) NOT NULL,
  `DESC_STATUT_ENT` varchar(256) NOT NULL,
  `OFFRE_STATUT_ENT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `statut_ent`
--

INSERT INTO `statut_ent` (`ID_STATUT_ENT`, `LIB_STATUT_ENT`, `DESC_STATUT_ENT`, `OFFRE_STATUT_ENT`) VALUES
(1, 'Validé', 'ORH vérifie les informations de votre entreprise. Vous ne pouvez pas encore déposer d\'offre.', 0),
(2, 'Non Validé', 'Vos informations ont été vérifiées. Vous pouvez commençer à déposer vos offres d\'emploi.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `supp_act`
--

CREATE TABLE `supp_act` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_ACT` int(11) NOT NULL,
  `DATE_SUPP_ACT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `supp_offre_site`
--

CREATE TABLE `supp_offre_site` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_OFFRE_SITE` int(11) NOT NULL,
  `DATE_SUPP_OFFRE_SITE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `supp_serv_cnd`
--

CREATE TABLE `supp_serv_cnd` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_SERV_CND` int(11) NOT NULL,
  `DATE_SUPP_SERV_CND` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `supp_serv_ent`
--

CREATE TABLE `supp_serv_ent` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_SERV_ENT` int(11) NOT NULL,
  `DATE_SUPP_SERV_CND_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_societe`
--

CREATE TABLE `type_societe` (
  `ID_TYPE_SOC` int(11) NOT NULL,
  `LIB_TYPE_SOC` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_societe`
--

INSERT INTO `type_societe` (`ID_TYPE_SOC`, `LIB_TYPE_SOC`) VALUES
(1, 'Multinationale'),
(2, 'Privée internationale'),
(3, 'Privéé nationale'),
(4, 'Publique'),
(5, 'Semi-publique'),
(6, 'PME/PMI');

-- --------------------------------------------------------

--
-- Structure de la table `ville`
--

CREATE TABLE `ville` (
  `ID_VILLE` int(11) NOT NULL,
  `LIB_VILLE` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ville`
--

INSERT INTO `ville` (`ID_VILLE`, `LIB_VILLE`) VALUES
(1, 'Abidjan'),
(2, 'San-Pédro');

-- --------------------------------------------------------

--
-- Structure de la table `voir_cnd`
--

CREATE TABLE `voir_cnd` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CND` int(11) NOT NULL,
  `DATE_VOIR_CND` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voir_cnd`
--

INSERT INTO `voir_cnd` (`ID_ADMIN`, `ID_CND`, `DATE_VOIR_CND`) VALUES
(1, 27, '2018-02-18 12:36:39'),
(1, 28, '2018-02-23 12:14:30');

-- --------------------------------------------------------

--
-- Structure de la table `voir_cv`
--

CREATE TABLE `voir_cv` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_CV` int(11) NOT NULL,
  `DATE_VOIR_CV` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voir_cv`
--

INSERT INTO `voir_cv` (`ID_ADMIN`, `ID_CV`, `DATE_VOIR_CV`) VALUES
(1, 2, '2018-02-23 12:28:32'),
(1, 1, '2018-03-08 10:58:31');

-- --------------------------------------------------------

--
-- Structure de la table `voir_ent`
--

CREATE TABLE `voir_ent` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_ENT` int(11) NOT NULL,
  `DATE_VOIR_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voir_ent`
--

INSERT INTO `voir_ent` (`ID_ADMIN`, `ID_ENT`, `DATE_VOIR_ENT`) VALUES
(1, 24, '2018-02-21 11:58:52'),
(1, 25, '2018-03-03 20:46:18');

-- --------------------------------------------------------

--
-- Structure de la table `voir_offre_ent`
--

CREATE TABLE `voir_offre_ent` (
  `ID_ADMIN` int(11) NOT NULL,
  `ID_OFFRE_ENT` int(11) NOT NULL,
  `DATE_VOIR_OFFRE_ENT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `voir_offre_ent`
--

INSERT INTO `voir_offre_ent` (`ID_ADMIN`, `ID_OFFRE_ENT`, `DATE_VOIR_OFFRE_ENT`) VALUES
(1, 30, '2018-02-12 19:01:49'),
(1, 33, '2018-02-25 02:37:59'),
(1, 34, '2018-03-03 21:22:26'),
(1, 35, '2018-03-03 22:00:36'),
(1, 36, '2018-03-08 11:01:38'),
(1, 37, '2018-03-08 11:37:02');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD PRIMARY KEY (`ID_ACT`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_ADMIN`);

--
-- Index pour la table `avoir_dom`
--
ALTER TABLE `avoir_dom`
  ADD PRIMARY KEY (`ID_CND`,`ID_DOM`),
  ADD KEY `ID_CND` (`ID_CND`),
  ADD KEY `ID_DOM` (`ID_DOM`);

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`ID_CND`),
  ADD KEY `ID_GENRE` (`ID_GENRE`),
  ADD KEY `ID_NAT` (`ID_NAT`),
  ADD KEY `ID_NIVEAU` (`ID_NIVEAU`),
  ADD KEY `ID_CONTRAT` (`ID_CONTRAT`),
  ADD KEY `ID_SIT_PROF` (`ID_SIT_PROF`),
  ADD KEY `ID_SIT_MAT` (`ID_SIT_MAT`);

--
-- Index pour la table `changer_hab`
--
ALTER TABLE `changer_hab`
  ADD KEY `ID_ADMIN_SUPER` (`ID_ADMIN_SUPER`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`);

--
-- Index pour la table `changer_statut_ent`
--
ALTER TABLE `changer_statut_ent`
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_ENT` (`ID_ENT`),
  ADD KEY `ID_SATUT_ENT` (`ID_SATUT_ENT`);

--
-- Index pour la table `compte_admin`
--
ALTER TABLE `compte_admin`
  ADD PRIMARY KEY (`ID_COMPTE_ADMIN`);

--
-- Index pour la table `compte_cnd`
--
ALTER TABLE `compte_cnd`
  ADD PRIMARY KEY (`ID_COMPTE_CND`);

--
-- Index pour la table `compte_ent`
--
ALTER TABLE `compte_ent`
  ADD PRIMARY KEY (`ID_COMPTE_ENT`);

--
-- Index pour la table `connexion_admin`
--
ALTER TABLE `connexion_admin`
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_COMPTE_ADMIN` (`ID_COMPTE_ADMIN`);

--
-- Index pour la table `connexion_cnd`
--
ALTER TABLE `connexion_cnd`
  ADD PRIMARY KEY (`ID_CND`,`ID_COMPTE_CND`,`DATE_CONN_CND`),
  ADD KEY `ID_CND` (`ID_CND`),
  ADD KEY `ID_COMPTE` (`ID_COMPTE_CND`);

--
-- Index pour la table `connexion_ent`
--
ALTER TABLE `connexion_ent`
  ADD KEY `ID_ENT` (`ID_ENT`),
  ADD KEY `ID_COMPTE_ENT` (`ID_COMPTE_ENT`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`ID_CONTRAT`);

--
-- Index pour la table `creer_compte_cnd`
--
ALTER TABLE `creer_compte_cnd`
  ADD PRIMARY KEY (`ID_CND`),
  ADD KEY `ID_CND` (`ID_CND`),
  ADD KEY `ID_COMPTE_CND` (`ID_COMPTE_CND`);

--
-- Index pour la table `creer_compte_ent`
--
ALTER TABLE `creer_compte_ent`
  ADD KEY `ID_ENT` (`ID_ENT`),
  ADD KEY `ID_COMPTE_ENT` (`ID_COMPTE_ENT`);

--
-- Index pour la table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`ID_CV`),
  ADD KEY `ID_CND` (`ID_CND`);

--
-- Index pour la table `domaine_comp`
--
ALTER TABLE `domaine_comp`
  ADD PRIMARY KEY (`ID_DOM`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID_ENT`),
  ADD KEY `ID_INTER` (`ID_INTER`),
  ADD KEY `ID_TYPE_SOC` (`ID_TYPE_SOC`),
  ADD KEY `ID_FORM_JUR` (`ID_FORM_JUR`),
  ADD KEY `ID_FORM_JUR_2` (`ID_FORM_JUR`),
  ADD KEY `ID_STATUT_ENT` (`ID_STATUT_ENT`);

--
-- Index pour la table `forme_juridique`
--
ALTER TABLE `forme_juridique`
  ADD PRIMARY KEY (`ID_FORM_JUR`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`ID_GENRE`);

--
-- Index pour la table `habilitation`
--
ALTER TABLE `habilitation`
  ADD PRIMARY KEY (`ID_HAB`);

--
-- Index pour la table `interlocuteur`
--
ALTER TABLE `interlocuteur`
  ADD PRIMARY KEY (`ID_INTER`),
  ADD KEY `ID_GENRE` (`ID_GENRE`);

--
-- Index pour la table `langue`
--
ALTER TABLE `langue`
  ADD PRIMARY KEY (`ID_LANG`);

--
-- Index pour la table `localiser_cnd`
--
ALTER TABLE `localiser_cnd`
  ADD PRIMARY KEY (`ID_CND`),
  ADD KEY `ID_CND` (`ID_CND`),
  ADD KEY `ID_PAYS` (`ID_PAYS`),
  ADD KEY `ID_VILLE` (`ID_VILLE`);

--
-- Index pour la table `localiser_ent`
--
ALTER TABLE `localiser_ent`
  ADD PRIMARY KEY (`ID_ENT`,`ID_PAYS`,`ID_VILLE`),
  ADD KEY `ID_ENT` (`ID_ENT`),
  ADD KEY `ID_PAYS` (`ID_PAYS`),
  ADD KEY `ID_VILLE` (`ID_VILLE`);

--
-- Index pour la table `nationnalite`
--
ALTER TABLE `nationnalite`
  ADD PRIMARY KEY (`ID_NAT`);

--
-- Index pour la table `niveau_etude`
--
ALTER TABLE `niveau_etude`
  ADD PRIMARY KEY (`ID_NIVEAU`);

--
-- Index pour la table `offre_ent`
--
ALTER TABLE `offre_ent`
  ADD PRIMARY KEY (`ID_OFFRE_ENT`),
  ADD KEY `ID_ENT` (`ID_ENT`);

--
-- Index pour la table `offre_site`
--
ALTER TABLE `offre_site`
  ADD PRIMARY KEY (`ID_OFFRE_SITE`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`);

--
-- Index pour la table `opere`
--
ALTER TABLE `opere`
  ADD PRIMARY KEY (`ID_ENT`,`ID_SECT`),
  ADD KEY `ID_ENT` (`ID_ENT`),
  ADD KEY `ID_SECT` (`ID_SECT`);

--
-- Index pour la table `parler`
--
ALTER TABLE `parler`
  ADD PRIMARY KEY (`ID_CND`,`ID_LANG`),
  ADD KEY `ID_CND` (`ID_CND`),
  ADD KEY `ID_LANG` (`ID_LANG`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`ID_PAYS`);

--
-- Index pour la table `secteur_act`
--
ALTER TABLE `secteur_act`
  ADD PRIMARY KEY (`ID_SECT`);

--
-- Index pour la table `service_cnd`
--
ALTER TABLE `service_cnd`
  ADD PRIMARY KEY (`ID_SERV_CND`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`);

--
-- Index pour la table `service_ent`
--
ALTER TABLE `service_ent`
  ADD PRIMARY KEY (`ID_SERV_ENT`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`);

--
-- Index pour la table `sit_matrimoniale`
--
ALTER TABLE `sit_matrimoniale`
  ADD PRIMARY KEY (`ID_SIT_MAT`);

--
-- Index pour la table `sit_professionnelle`
--
ALTER TABLE `sit_professionnelle`
  ADD PRIMARY KEY (`ID_SIT_PROF`);

--
-- Index pour la table `souscrire_cnd`
--
ALTER TABLE `souscrire_cnd`
  ADD PRIMARY KEY (`ID_CND`,`ID_SERV_CND`),
  ADD KEY `FK_SOUSCRIPTIONCND_ID_SERV_CND` (`ID_SERV_CND`),
  ADD KEY `ID_CND` (`ID_CND`);

--
-- Index pour la table `souscrire_ent`
--
ALTER TABLE `souscrire_ent`
  ADD PRIMARY KEY (`ID_ENT`,`ID_SERV_ENT`),
  ADD KEY `ID_ENT` (`ID_ENT`),
  ADD KEY `ID_SERV_ENT` (`ID_SERV_ENT`);

--
-- Index pour la table `statut_ent`
--
ALTER TABLE `statut_ent`
  ADD PRIMARY KEY (`ID_STATUT_ENT`);

--
-- Index pour la table `supp_act`
--
ALTER TABLE `supp_act`
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_ACT` (`ID_ACT`);

--
-- Index pour la table `supp_serv_cnd`
--
ALTER TABLE `supp_serv_cnd`
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_SERV_CND` (`ID_SERV_CND`);

--
-- Index pour la table `supp_serv_ent`
--
ALTER TABLE `supp_serv_ent`
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_SERV_ENT` (`ID_SERV_ENT`);

--
-- Index pour la table `type_societe`
--
ALTER TABLE `type_societe`
  ADD PRIMARY KEY (`ID_TYPE_SOC`);

--
-- Index pour la table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`ID_VILLE`);

--
-- Index pour la table `voir_cnd`
--
ALTER TABLE `voir_cnd`
  ADD PRIMARY KEY (`ID_ADMIN`,`ID_CND`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_CND` (`ID_CND`);

--
-- Index pour la table `voir_cv`
--
ALTER TABLE `voir_cv`
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_CV` (`ID_CV`);

--
-- Index pour la table `voir_ent`
--
ALTER TABLE `voir_ent`
  ADD PRIMARY KEY (`ID_ADMIN`,`ID_ENT`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_ENT` (`ID_ENT`);

--
-- Index pour la table `voir_offre_ent`
--
ALTER TABLE `voir_offre_ent`
  ADD PRIMARY KEY (`ID_ADMIN`,`ID_OFFRE_ENT`),
  ADD KEY `ID_ADMIN` (`ID_ADMIN`),
  ADD KEY `ID_OFFRE_ENT` (`ID_OFFRE_ENT`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actualite`
--
ALTER TABLE `actualite`
  MODIFY `ID_ACT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `ID_CND` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `compte_admin`
--
ALTER TABLE `compte_admin`
  MODIFY `ID_COMPTE_ADMIN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `compte_cnd`
--
ALTER TABLE `compte_cnd`
  MODIFY `ID_COMPTE_CND` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `compte_ent`
--
ALTER TABLE `compte_ent`
  MODIFY `ID_COMPTE_ENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `ID_CONTRAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `cv`
--
ALTER TABLE `cv`
  MODIFY `ID_CV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `domaine_comp`
--
ALTER TABLE `domaine_comp`
  MODIFY `ID_DOM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID_ENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `forme_juridique`
--
ALTER TABLE `forme_juridique`
  MODIFY `ID_FORM_JUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `ID_GENRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `habilitation`
--
ALTER TABLE `habilitation`
  MODIFY `ID_HAB` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `interlocuteur`
--
ALTER TABLE `interlocuteur`
  MODIFY `ID_INTER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT pour la table `langue`
--
ALTER TABLE `langue`
  MODIFY `ID_LANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `nationnalite`
--
ALTER TABLE `nationnalite`
  MODIFY `ID_NAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `niveau_etude`
--
ALTER TABLE `niveau_etude`
  MODIFY `ID_NIVEAU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `offre_ent`
--
ALTER TABLE `offre_ent`
  MODIFY `ID_OFFRE_ENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `offre_site`
--
ALTER TABLE `offre_site`
  MODIFY `ID_OFFRE_SITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `ID_PAYS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `secteur_act`
--
ALTER TABLE `secteur_act`
  MODIFY `ID_SECT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `service_cnd`
--
ALTER TABLE `service_cnd`
  MODIFY `ID_SERV_CND` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `service_ent`
--
ALTER TABLE `service_ent`
  MODIFY `ID_SERV_ENT` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sit_matrimoniale`
--
ALTER TABLE `sit_matrimoniale`
  MODIFY `ID_SIT_MAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `sit_professionnelle`
--
ALTER TABLE `sit_professionnelle`
  MODIFY `ID_SIT_PROF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `statut_ent`
--
ALTER TABLE `statut_ent`
  MODIFY `ID_STATUT_ENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `type_societe`
--
ALTER TABLE `type_societe`
  MODIFY `ID_TYPE_SOC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ville`
--
ALTER TABLE `ville`
  MODIFY `ID_VILLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD CONSTRAINT `fk_actualite_id_admin` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Contraintes pour la table `avoir_dom`
--
ALTER TABLE `avoir_dom`
  ADD CONSTRAINT `fk_ID_CND` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ID_DOM` FOREIGN KEY (`ID_DOM`) REFERENCES `domaine_comp` (`ID_DOM`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `FK_CANDIDAT_ID_CONTRAT` FOREIGN KEY (`ID_CONTRAT`) REFERENCES `contrat` (`ID_CONTRAT`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CANDIDAT_ID_GENRE` FOREIGN KEY (`ID_GENRE`) REFERENCES `genre` (`ID_GENRE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CANDIDAT_ID_NAT` FOREIGN KEY (`ID_NAT`) REFERENCES `nationnalite` (`ID_NAT`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CANDIDAT_ID_NIVEAU` FOREIGN KEY (`ID_NIVEAU`) REFERENCES `niveau_etude` (`ID_NIVEAU`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CANDIDAT_ID_SIT_PROF` FOREIGN KEY (`ID_SIT_PROF`) REFERENCES `sit_professionnelle` (`ID_SIT_PROF`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `changer_hab`
--
ALTER TABLE `changer_hab`
  ADD CONSTRAINT `FK_CHANGER_HAB_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CHANGER_HAB_ID_ADMIN_SUPER` FOREIGN KEY (`ID_ADMIN_SUPER`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `changer_statut_ent`
--
ALTER TABLE `changer_statut_ent`
  ADD CONSTRAINT `FK_CHANGESTATUTENT_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CHANGESTATUTENT_ID_ENT` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CHANGESTATUTENT_ID_STATUT_ENT` FOREIGN KEY (`ID_SATUT_ENT`) REFERENCES `statut_ent` (`ID_STATUT_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `connexion_admin`
--
ALTER TABLE `connexion_admin`
  ADD CONSTRAINT `FKCONNEXIONADMIN_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKCONNEXIONADMIN_ID_cOMPTE_ADMIN` FOREIGN KEY (`ID_COMPTE_ADMIN`) REFERENCES `compte_admin` (`ID_COMPTE_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `connexion_cnd`
--
ALTER TABLE `connexion_cnd`
  ADD CONSTRAINT `FK_CONNEXIONCND_ID_CND` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_CONNEXIONCND_ID_COMPTE` FOREIGN KEY (`ID_COMPTE_CND`) REFERENCES `compte_cnd` (`ID_COMPTE_CND`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `creer_compte_cnd`
--
ALTER TABLE `creer_compte_cnd`
  ADD CONSTRAINT `fk_creercomptecnd_idcnd` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_creercomptecnd_idcomptecnd` FOREIGN KEY (`ID_COMPTE_CND`) REFERENCES `compte_cnd` (`ID_COMPTE_CND`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `creer_compte_ent`
--
ALTER TABLE `creer_compte_ent`
  ADD CONSTRAINT `fk_creercompteent_idcompteent` FOREIGN KEY (`ID_COMPTE_ENT`) REFERENCES `compte_ent` (`ID_COMPTE_ENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_creercompteent_ident` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `fk_cv_id_cnd` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_ENTREPRISE_ID_FORM_JUR` FOREIGN KEY (`ID_FORM_JUR`) REFERENCES `forme_juridique` (`ID_FORM_JUR`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENTREPRISE_ID_INTER` FOREIGN KEY (`ID_INTER`) REFERENCES `interlocuteur` (`ID_INTER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENTREPRISE_ID_STATUT_ENT` FOREIGN KEY (`ID_STATUT_ENT`) REFERENCES `statut_ent` (`ID_STATUT_ENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ENTREPRISE_ID_TYPE_SOC` FOREIGN KEY (`ID_TYPE_SOC`) REFERENCES `type_societe` (`ID_TYPE_SOC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `interlocuteur`
--
ALTER TABLE `interlocuteur`
  ADD CONSTRAINT `fk_interlocuteur_ID_genre` FOREIGN KEY (`ID_GENRE`) REFERENCES `genre` (`ID_GENRE`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `localiser_cnd`
--
ALTER TABLE `localiser_cnd`
  ADD CONSTRAINT `FK_LOCALISERCND_ID_CND` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LOCALISERCND_ID_PAYS` FOREIGN KEY (`ID_PAYS`) REFERENCES `pays` (`ID_PAYS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_LOCALISERCND_ID_VILLE` FOREIGN KEY (`ID_VILLE`) REFERENCES `ville` (`ID_VILLE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `localiser_ent`
--
ALTER TABLE `localiser_ent`
  ADD CONSTRAINT `fk_localiser_ent_ID_ENT` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_localiser_ent_ID_PAYS` FOREIGN KEY (`ID_PAYS`) REFERENCES `pays` (`ID_PAYS`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_localiser_ent_ID_VILE` FOREIGN KEY (`ID_VILLE`) REFERENCES `ville` (`ID_VILLE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offre_ent`
--
ALTER TABLE `offre_ent`
  ADD CONSTRAINT `FK_OFFRIREMPLOIENT_ID_ENT` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `offre_site`
--
ALTER TABLE `offre_site`
  ADD CONSTRAINT `fk_offresite_id_admin` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `opere`
--
ALTER TABLE `opere`
  ADD CONSTRAINT `fk_id_ent_opere` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_sect_act_opere` FOREIGN KEY (`ID_SECT`) REFERENCES `secteur_act` (`ID_SECT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `parler`
--
ALTER TABLE `parler`
  ADD CONSTRAINT `fk_CND` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_LANG` FOREIGN KEY (`ID_LANG`) REFERENCES `langue` (`ID_LANG`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `service_cnd`
--
ALTER TABLE `service_cnd`
  ADD CONSTRAINT `fk_ID_ADMIN_serv_cnd` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Contraintes pour la table `service_ent`
--
ALTER TABLE `service_ent`
  ADD CONSTRAINT `fk_ID_ADMIN_serv_ent` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`);

--
-- Contraintes pour la table `souscrire_cnd`
--
ALTER TABLE `souscrire_cnd`
  ADD CONSTRAINT `FK_SOUSCRIPTIONCND_ID_CND` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SOUSCRIPTIONCND_ID_SERV_CND` FOREIGN KEY (`ID_SERV_CND`) REFERENCES `service_cnd` (`ID_SERV_CND`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `souscrire_ent`
--
ALTER TABLE `souscrire_ent`
  ADD CONSTRAINT `FK_SOUSCRIREENT_ID_ENT` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SOUSCRIREENT_ID_SERV_ENT` FOREIGN KEY (`ID_SERV_ENT`) REFERENCES `service_ent` (`ID_SERV_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `supp_act`
--
ALTER TABLE `supp_act`
  ADD CONSTRAINT `FK_SUPP_ACT_ID_ACT` FOREIGN KEY (`ID_ACT`) REFERENCES `actualite` (`ID_ACT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SUPP_ACT_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `supp_serv_cnd`
--
ALTER TABLE `supp_serv_cnd`
  ADD CONSTRAINT `FKSUPPECRIRESERVCND_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKSUPPECRIRESERVCND_ID_SERV_CND` FOREIGN KEY (`ID_SERV_CND`) REFERENCES `service_cnd` (`ID_SERV_CND`);

--
-- Contraintes pour la table `supp_serv_ent`
--
ALTER TABLE `supp_serv_ent`
  ADD CONSTRAINT `FK_SUPPSERVENT_ID_ADMIN` FOREIGN KEY (`ID_SERV_ENT`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SUPPSERVENT_ID_SERV_ENT` FOREIGN KEY (`ID_SERV_ENT`) REFERENCES `service_ent` (`ID_SERV_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voir_cnd`
--
ALTER TABLE `voir_cnd`
  ADD CONSTRAINT `FK_VOIRCND_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VOIRCND_ID_CND` FOREIGN KEY (`ID_CND`) REFERENCES `candidat` (`ID_CND`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voir_cv`
--
ALTER TABLE `voir_cv`
  ADD CONSTRAINT `FK_VOIRCV_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VOIRCV_ID_CV` FOREIGN KEY (`ID_CV`) REFERENCES `cv` (`ID_CV`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voir_ent`
--
ALTER TABLE `voir_ent`
  ADD CONSTRAINT `fk_voir_ent_idadmin` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_voir_ent_ident` FOREIGN KEY (`ID_ENT`) REFERENCES `entreprise` (`ID_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voir_offre_ent`
--
ALTER TABLE `voir_offre_ent`
  ADD CONSTRAINT `FK_VOIROFFREENT_ID_ADMIN` FOREIGN KEY (`ID_ADMIN`) REFERENCES `admin` (`ID_ADMIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VOIROFFREENT_ID_OFFRE_ENT` FOREIGN KEY (`ID_OFFRE_ENT`) REFERENCES `offre_ent` (`ID_OFFRE_ENT`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
