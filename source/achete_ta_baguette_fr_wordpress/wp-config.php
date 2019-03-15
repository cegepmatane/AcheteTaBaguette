<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wordpress' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'admin' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '@2minBDD' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Q^}=^&Co1yzMHM$ Jk<18}43XL=Ba0o5`Lw?,wxU<Z(uN$uD68ui+EXH$({v}R1-' );
define( 'SECURE_AUTH_KEY',  '?q0_JT@F}(?Fz]ayCGW$P.`Vz_CUHbL?s{V6dV`-_yq(hb*q),7,oH`/RyfP;il=' );
define( 'LOGGED_IN_KEY',    ',5SUG{Cob_[P9FF_cviBDby2y%efyKdiNI,hmu[X0hzS1M^O^t}D7+6 )cxgh@VZ' );
define( 'NONCE_KEY',        'Ry$GriT{,1Mo|k0IUGS^6Q%2F6~r|W5&7>hbIzV2Y:WgEso8p>~IEU>xU}^KRPnz' );
define( 'AUTH_SALT',        '<}y{YN*Eq7=I8hZ5!;]!kYWH4oQTY8!frA<CfgBm &*fVv3FbiFAm(^Z*6018X$y' );
define( 'SECURE_AUTH_SALT', '6~E3skgDDW/2+vK2fv6IDC`vB@o9Y<&.iFF_e!dL[$~YhUXCR5_lwhIh/hy=RmHu' );
define( 'LOGGED_IN_SALT',   'lBAL3DyJlQlwAjOV,:.SD(r.G~xF{no&pl=?_`)y]Es**?Cfz4;nW$&+cHROzI:R' );
define( 'NONCE_SALT',       'f(zaNB@z)9x[erL#^.r?b%Qn]!*I*Wck!:Xr?+](YLYBy`wk8d?w(KcN$i~3kQ?a' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
