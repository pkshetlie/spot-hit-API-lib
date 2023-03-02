<?php

namespace SpotHit\Client\Model;

class SmsMessage extends BaseMessage
{
    /**
     * @var string
     * Limité à 160 caractères (ou voir paramètre smslong).
     * Attention : Les caractères , ^, €, }, {, [, ~, ] et \ comptent doubles.
     * Dans une requête de type GET, utiliser le caractère \n pour effectuer un retour à la ligne. Les caractères %0A, <br>, <br />, <br/> et \n\ sont automatiquement remplacés par un retour à la ligne.
     * SMS Personnalisé : {Nom de la colonne}, exemple : {Nom}
     * Pour rappel, afin de respecter les obligations légales de la CNIL, il est impératif d'inclure une mention de désinscription. Afin que votre campagne soit validée, il vous faut inclure la mention « STOP au 36200 » dans votre message.
     */
    private string $message;

    /** @var string[]
     * Liste de numéros de vos destinataires
     */
    private array $destinataires;

    /** @var ?string
     * 11 caractères maximum (espaces inclus)
     */
    private ?string $expediteur;

    /** @var ?string
     * Date d'envoi du message (format timestamp)
     */
    private ?string $date;

    /** @var ?int
     * Si égal à "1", autorise l'envoi de SMS supérieur à 160 caractères. Un SMS vous sera facturé tous les 153 caractères.
     * Exemple : pour un message de 300 caractères à 1000 destinataires, 2000 SMS vous seront débités.
     * Maximum 9 SMS concaténés (soit 1377 caractères)
     */
    private ?int $smslong;

    /** @var ?int
     * Permet de vérifier la taille du SMS long envoyé. Vous devez envoyer le nombre de SMS concaténés comme valeur. Si notre compteur nous indique un nombre différent, votre message sera rejeté.
     */
    private ?int $smslongnbr;

    /** @var ?int
     * Si égal à "1", tronque automatiquement le message à 160 caractères.
     */
    private ?int $tronque;

    /** @var ?string
     * si égal à "auto", conversion de votre message en UTF-8 (il est conseillé de convertir votre message en UTF-8 dans votre application cependant si votre message reste coupé après un caractère accentué, vous pouvez activer ce paramètre).
    si égal à "ucs2", conversion de votre message en unicode (vous pouvez utiliser des caractères supplémentaires comme « ê » qui n'est pas pris en compte en SMS standard, ainsi qu'inclure des emojis. Attention : Le nombre de caractères est limité à 70, et 67 en SMS Long.)
     */
    private ?string $encodage;

    /** @var ?string
     * Cette information non visible par les destinataires vous permet d’identifier votre campagne (maximum 255 caractères).
     */
    private ?string $nom;

    /** @var ?string "all" | "groupe" | "datas"
     * Permet la sélection de contacts déjà enregistrés sur le compte client :
     * all = sélection de tous les contacts du compte.
     * groupe = sélection de tous les contacts des groupes fournis dans le champ « destinataires » (un tableau contenant les identifiants des groupes est requis)
     * datas = permet d'ajouter des données personnalisées aux « destinataires » pour les utiliser dans votre message (exemple : "Bonjour {nom} {prenom}"), pour ce faire il faut que le champ
     * « destinataires » soit un tableau de cette forme : ["+33600000001" => ["nom" => "Nom 1", "prenom" => "Prénom 1"], "+33600000002" => ["nom" => "Nom 2", "prenom" => "Prénom 2"] ...]
     */
    private ?string $destinataires_type;

    /** @var ?string
     * Adresse URL de votre serveur pour la réception en "push" des statuts après l'envoi. Vous devez déjà avoir une adresse paramétrée sur votre compte pour activer les retours "push". Si ce paramètre est renseigné, cette URL sera appelée pour cet envoi sinon l'adresse du compte est utilisée.
     */
    private ?string $urlOptionnel;

    /** @var ?string
     * obligatoire pour l'envoi échelonné
     * Date de début d'envoi des messages (format timestamp)
     */
    private ?string $date_debut;

    /** @var ?string
     * obligatoire pour l'envoi échelonné
     * Date de fin d'envoi des messages (format timestamp)
     */
    private ?string $date_fin;

    /** @var ?int[]
     * obligatoire pour l'envoi échelonné
     * Heure(s) d'envois
     * Tableau avec 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19
     * La campagne sera fractionnée proportionnellement aux nombres de créneaux entre le jour et l'heure de démarrage, et le jour et l'heure de fin souhaitée.
     */
    private ?array $creneaux;

    /** @var ?int
     * obligatoire pour l'envoi échelonné
     * 1,2,3,4 ou 6 Nombre d'envois par heure
     */
    private ?int $creneaux_heure;
    
    /** @var ?int[]
     * obligatoire pour l'envoi échelonné
     * Tableau avec 1,2,3,4,5,6
     * Jours d'envoi (1 représentant lundi). Pas d'envoi le dimanche.
     */
    private ?array $jours;

    /** @var ?string
     * Permet de modifier le fuseau horaire.
     * Par défaut : Europe/Paris
     */
    private ?string $timezone;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return SmsMessage
     */
    public function setMessage(string $message): SmsMessage
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDestinataires(): array
    {
        return $this->destinataires;
    }

    /**
     * @param string[] $destinataires
     * @return SmsMessage
     */
    public function setDestinataires(array $destinataires): SmsMessage
    {
        $this->destinataires = $destinataires;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExpediteur(): ?string
    {
        return $this->expediteur;
    }

    /**
     * @param ?string $expediteur
     * @return SmsMessage
     */
    public function setExpediteur(?string $expediteur): SmsMessage
    {
        $this->expediteur = $expediteur;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param ?string $date
     * @return SmsMessage
     */
    public function setDate(?string $date): SmsMessage
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return ?int
     */
    public function getSmslong(): ?int
    {
        return $this->smslong;
    }

    /**
     * @param ?int $smslong
     * @return SmsMessage
     */
    public function setSmslong(?int $smslong): SmsMessage
    {
        $this->smslong = $smslong;
        return $this;
    }

    /**
     * @return ?int
     */
    public function getSmslongnbr(): ?int
    {
        return $this->smslongnbr;
    }

    /**
     * @param ?int $smslongnbr
     * @return SmsMessage
     */
    public function setSmslongnbr(?int $smslongnbr): SmsMessage
    {
        $this->smslongnbr = $smslongnbr;
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTronque(): ?int
    {
        return $this->tronque;
    }

    /**
     * @param ?int $tronque
     * @return SmsMessage
     */
    public function setTronque(?int $tronque): SmsMessage
    {
        $this->tronque = $tronque;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEncodage(): ?string
    {
        return $this->encodage;
    }

    /**
     * @param ?string $encodage
     * @return SmsMessage
     */
    public function setEncodage(?string $encodage): SmsMessage
    {
        $this->encodage = $encodage;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param ?string $nom
     * @return SmsMessage
     */
    public function setNom(?string $nom): SmsMessage
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDestinatairesType(): ?string
    {
        return $this->destinataires_type;
    }

    /**
     * @param ?string $destinataires_type
     * @return SmsMessage
     */
    public function setDestinatairesType(?string $destinataires_type): SmsMessage
    {
        $this->destinataires_type = $destinataires_type;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUrlOptionnel(): ?string
    {
        return $this->urlOptionnel;
    }

    /**
     * @param ?string $urlOptionnel
     * @return SmsMessage
     */
    public function setUrlOptionnel(?string $urlOptionnel): SmsMessage
    {
        $this->urlOptionnel = $urlOptionnel;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDateDebut(): ?string
    {
        return $this->date_debut;
    }

    /**
     * @param ?string $date_debut
     * @return SmsMessage
     */
    public function setDateDebut(?string $date_debut): SmsMessage
    {
        $this->date_debut = $date_debut;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDateFin(): ?string
    {
        return $this->date_fin;
    }

    /**
     * @param ?string $date_fin
     * @return SmsMessage
     */
    public function setDateFin(?string $date_fin): SmsMessage
    {
        $this->date_fin = $date_fin;
        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getCreneaux(): ?array
    {
        return $this->creneaux;
    }

    /**
     * @param int[]|null $creneaux
     * @return SmsMessage
     */
    public function setCreneaux(?array $creneaux): SmsMessage
    {
        $this->creneaux = $creneaux;
        return $this;
    }

    /**
     * @return ?int
     */
    public function getCreneauxHeure(): ?int
    {
        return $this->creneaux_heure;
    }

    /**
     * @param ?int $creneaux_heure
     * @return SmsMessage
     */
    public function setCreneauxHeure(?int $creneaux_heure): SmsMessage
    {
        $this->creneaux_heure = $creneaux_heure;
        return $this;
    }

    /**
     * @return int[]|null
     */
    public function getJours(): ?array
    {
        return $this->jours;
    }

    /**
     * @param int[]|null $jours
     * @return SmsMessage
     */
    public function setJours(?array $jours): SmsMessage
    {
        $this->jours = $jours;
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    /**
     * @param ?string $timezone
     * @return SmsMessage
     */
    public function setTimezone(?string $timezone): SmsMessage
    {
        $this->timezone = $timezone;
        return $this;
    }

    public function toArray()
    {
        $r = [];
        foreach ($this as $k => $v) {
            if ($v !== null) {
                $r[$k] = $v;
            }
        }
        return $r;
    }
    
}