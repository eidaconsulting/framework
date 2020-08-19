<?php

namespace Core\Paiements;


use Core\Config;
use FedaPay\Customer;
use FedaPay\FedaPay;
use FedaPay\Transaction;

class Paiements extends FedaPay
{
    //Install before fedapay with the code  require fedapay/fedapay-php

    private $public_key;
    private $type;

    public function __construct ()
    {
        $config = new Config();
        $this->public_key = $config->get('fp_private_key');
        $this->type = $config->get('fp_type');
        FedaPay::setApiKey($this->public_key);
        FedaPay::setEnvironment($this->type);
    }

    /**
     * Affiche la liste des clients Fedapay
     * Elle retourne un objet comportant le informations suivantes :
     * id (int), firstname (string), lastname (string), email (string), phone (string)
     */
    public function getCustomers (): array
    {

        /**
         * @var \FedaPay\FedaPayObject
         */
        $response = Customer::all();
        $customers = $response->customers;
        $meta = $response->meta;

        return $customers;
    }

    /**
     * Creer un nouveau client pour le compte FedaPay
     *
     * @param string $firstame : Le prenom du client
     * @param string $lastname : Le nom du client
     * @param string $email    : L'email du client
     * @param array  $phone    : Le numéro de téléphone du client au format +229 97 76 78 99
     *                         exemple de [ "number" => $phone, "country" => 'bj' // 'bj' code indicatif du Bénin ]
     * @return mixed
     */
    public function createCustomers (string $firstame, string $lastname, string $email, array $phone = [])
    {

        Customer::create([
            "firstname" => $firstame,
            "lastname" => $lastname,
            "email" => $email,
            "phone" => $phone
        ]);

    }

    /**
     * @param int    $id       : id du client
     * @param string $firstame : Le prenom du client
     * @param string $lastname : Le nom du client
     * @param string $email    : L'email du client
     * @param string $phone    : Le numéro de téléphone du client au format +229 97 76 78 99
     * @return mixed
     */
    public function updateCustomers (int $id, string $firstame, string $lastname, string $email, array $phone)
    {

        /*$customer = \FedaPay\Customer::retrieve(2);
        $customer->firstname = "Eric";
        $customer->firstname = "Eric";
        $customer->firstname = "Eric";
        $customer->firstname = "Eric";
        $customer->save();*/
        // Or

        $customer = Customer::update($id, [
            "firstname" => $firstame,
            "lastname" => $lastname,
            "email" => $email,
            "phone" => $phone,
        ]);

        return $customer;
    }


    /**
     * Retourne les informations liéés a un client
     * Elle retourne les informations suivantes :
     * id (int), firstname (string), lastname (string), email (string), phone (string)
     *
     * @param $id : id du client dont on veux recuperer les informations
     * @return object
     */
    public function getCustomerById (int $id): object
    {
        $customer = Customer::retrieve($id);

        return $customer;
    }

    /**
     * Permet de supprimer un client depuis la base de données
     *
     * @param int $id
     */
    public function deleteCustomer (int $id)
    {
        Customer::delete($id);
    }

    /**
     * Récupère les détails sur le client.
     *
     * @param int $id : id du client.
     * @return \FedaPay\ApiOperations\FedaPay\FedaPayObject
     */
    public function retreiveCustomer (int $id)
    {
        return Customer::retrieve($id);
    }


    /**
     * Affiche la liste des transactions
     *
     * @return mixed
     */
    public function transactions ()
    {
        /**
         * @var \FedaPay\FedaPayObject
         */
        $response = Transaction::all();
        $transactions = $response->transactions;
        $meta = $response->meta;

        return $transactions;
    }

    /**
     * Crée une nouvelle transaction
     *
     * @param string $description : Description de la transaction
     * @param int    $amount      : Le montant total de la transaction
     * @param int    $item        : Le nombre total d'articles / services achetés sur le site marchand.
     * @param string $callbackUrl : Le lien de retour une fois que la transaction aurait été effectuée
     * @param array  $currency    : La devise de la transaction. Fournir soit le code soit l'iso
     * @param string $firstame    : Le prenom du client
     * @param string $lastname    : Le nom du client
     * @param string $email       : L'email du client
     * @param array  $phone       : Le numéro de téléphone du client au format +229 97 76 78 99
     *                            exemple de [ "number" => $phone, "country" => 'bj' // 'bj' code indicatif du Bénin ]
     */
    public function createTransaction (string $description, int $amount, string $callbackUrl, array $currency,
                                       string $firstname, string $lastname, string $email, array $phone = [])
    {


        Transaction::create([
            "description" => $description,
            "amount" => $amount,
            "callback_url" => $callbackUrl,
            "currency" => $currency,
            "customer" => [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "phone_number" => $phone
            ]
        ]);

    }


    public function retreiveTransaction ($id)
    {
        Transaction::retrieve(2);
    }


}