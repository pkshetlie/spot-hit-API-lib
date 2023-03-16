<?php

namespace SpotHit\Client\Exception;

abstract class MessageException extends \Exception
{
    const TYPE_SMS = 'SMS';
    const TYPE_VOCAL = 'VOCAL';
    const TYPE_EMAIL = 'EMAIL';
    const TYPE_MMS = 'MMS';
    const TYPE = 'UNKNOWN';

    const ERRORS = [
        '1'   => 'Type de message non spécifié ou incorrect (paramètre "type")',
        '2'   => 'Le message est vide',
        '3'   => 'Le message contient plus de 160 caractères (70 en unicode)',
        '4'   => 'Aucun destinataire valide n\'est renseigné',
        '5'   => 'Numéro interdit',
        '6'   => 'Numéro de destinataire invalide',
        '7'   => 'Votre compte n\'a pas de formule définie',
        '8'   => [
            'SMS'   => 'L\'expéditeur est invalide',
            'VOCAL' => 'L\'expéditeur est invalide',
            'EMAIL' => 'L\'e-mail d\'expédition est invalide',
            'MMS'   => 'Le sujet contient plus de 16 caractères.',
        ],
        '9'   => 'Le système a rencontré une erreur, merci de nous contacter',
        '10	Vous ne disposez pas d\'assez de crédits pour effectuer cet envoi',
        '11'  => 'L\'envoi des message est désactivé pour la démonstration',
        '12'  => 'Votre compte a été suspendu. Contactez-nous pour plus d\'informations',
        '13'  => 'Votre limite d\'envoi paramétrée est atteinte. Contactez-nous pour plus d\'informations',
        '14'  => 'Votre limite d\'envoi paramétrée est atteinte. Contactez-nous pour plus d\'informations',
        '15'  => 'Votre limite d\'envoi paramétrée est atteinte. Contactez-nous pour plus d\'informations',
        '16'  => '	Le paramètre "smslongnbr" n\'est pas cohérent avec la taille du message envoyé',
        '17'  => 'L\'expéditeur n\'est pas autorisé',
        '18'  => [
            'EMAIL' => 'Le sujet est trop court'
        ],
        '19'  => [
            'EMAIL' => 'L\'email de réponse est invalide'
        ],
        '20'  => [
            'EMAIL' => 'Le nom d\'expéditeur est trop court'
        ],
        '21'  => 'Token invalide. Contactez-nous pour plus d\'informations',
        '22'  => 'Durée du message non autorisée. Contactez-nous pour plus d\'informations',
        '23'  => 'Aucune date variable valide n\'a été trouvée dans votre liste de destinataires',
        '24'  => 'Votre campagne n\'a pas été validée car il manque la mention « STOP au 36200 » dans votre message. Pour rappel, afin de respecter les obligations légales de la CNIL, il est impératif d\'inclure une mention de désinscription',
        '25'  => 'Echelonnage : date de début vide',
        '26'  => 'Echelonnage : date de fin vide',
        '27'  => 'Echelonnage : date de début plus tard que date de fin',
        '28'  => 'Echelonnage : aucun créneau disponible',
        '29'  => [
            'MMS' => 'Le mot "virtual" peut générer des anomalies dans le routage de vos messages. Nous vous invitons à utiliser un synonyme ou une autre écriture (Virtuel par exemple). Nous sommes en train de corriger cette anomalie, veuillez-nous excuser pour la gêne occasionnée'
        ],
        '30'  => 'Clé API non reconnue',
        '36'  => 'Vous ne pouvez pas avoir d\'emojis dans votre message',
        '38'  => 'Vous devez ajouter une mention "Stop" à votre SMS',
        '40'  => 'Une pièce jointe ne vous appartient pas',
        '41'  => 'Une pièce jointe est invalide',
        '45'  => 'Ce produit n\'est pas activé',
        '50'  => 'Le fuseau horaire spécifié n\'est pas valide',
        '51'  => 'La date est déjà passée après calcule du fuseau horaire',
        '52'  => 'Vous avez atteint la limite maximale de 50 campagnes en brouillons. Si vous souhaitez en ajouter plus, merci de nous contacter',
        '53'  => 'Nous limitons à 5 pièces jointes par campagne email',
        '61'  => 'Nous avons détecté un lien dans le contenu de votre message, merci de vous rapprocher de notre service client pour valider cet envoi',
        '62'  => 'Votre limite d\'envoi est atteinte',
        '63'  => 'Vous avez dépassé votre limite de requêtes api',
        '65'  => 'Une maintenance est prévu sur ce créneaux horaire',
        '66'  => 'Nous avons bloqué préventivement cette campagne car elle présente des caractéristiques similaires à une campagne déjà envoyée (contenu, destinataires...). Merci de nous contacter pour plus d\'informations',
        '67'  => 'Le nom d\'expéditeur ne peut contenir une adresse email',
        '68'  => 'Nous avons détecté un numéro de téléphone dans le contenu de votre message, merci de vous rapprocher de notre service client pour valider cet envoi.',
        '99'  => 'Une maintenance est prévu sur ce créneaux horaire',
        '100' => 'Ip non autorisée',
    ];

    public function __construct( $error)
    {
        if (isset(self::ERRORS[$error])) {
            $errorToThrow = self::ERRORS[$error];
            if (is_array($errorToThrow)) {
                if (isset($errorToThrow[self::TYPE])) {
                    parent::__construct($errorToThrow[self::TYPE]);
                } else {
                    parent::__construct('Erreur ' . self::TYPE . ' inconnue');
                }
            } else {
                parent::__construct($errorToThrow);
            }
        } else {
            parent::__construct('Erreur ' . self::TYPE . ' n° ' . $error . ' inconnue');
        }
    }
}