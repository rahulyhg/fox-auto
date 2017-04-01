<?php
namespace Fox\Core\ExternalAccount;

use \Fox\Core\Exceptions\Error;
use \Fox\Core\Exceptions\Forbidden;
use \Fox\Core\Exceptions\NotFound;

class ClientManager
{
    protected $entityManager;

    protected $metadata;

    protected $clientMap = array();

    public function __construct($entityManager, $metadata, $config)
    {
        $this->entityManager = $entityManager;
        $this->metadata = $metadata;
        $this->config = $config;
    }

    public function storeAccessToken($hash, $data)
    {
        if (!empty($this->clientMap[$hash]) && !empty($this->clientMap[$hash]['externalAccountEntity'])) {
            $externalAccountEntity = $this->clientMap[$hash]['externalAccountEntity'];
            $externalAccountEntity->set('accessToken', $data['accessToken']);
            $externalAccountEntity->set('tokenType', $data['tokenType']);
            $this->entityManager->saveEntity($externalAccountEntity);
        }
    }

    public function create($integration, $userId)
    {
        $authMethod = $this->metadata->get("integrations.{$integration}.authMethod");
        $methodName = 'create' . ucfirst($authMethod);
        return $this->$methodName($integration, $userId);
    }

    protected function createOAuth2($integration, $userId)
    {
        $integrationEntity = $this->entityManager->getEntity('Integration', $integration);
        $externalAccountEntity = $this->entityManager->getEntity('ExternalAccount', $integration . '__' . $userId);

        $className = $this->metadata->get("integrations.{$integration}.clientClassName");

        $redirectUri = $this->config->get('siteUrl') . '?entryPoint=oauthCallback'; // TODO move to client class

        if (!$externalAccountEntity) {
            throw new Error("External Account {$integration} not found for {$userId}");
        }

        if (!$integrationEntity->get('enabled')) {
            return null;
        }
        if (!$externalAccountEntity->get('enabled')) {
            return null;
        }

        $oauth2Client = new \Fox\Core\ExternalAccount\OAuth2\Client();

        $client = new $className($oauth2Client, array(
            'endpoint' => $this->metadata->get("integrations.{$integration}.params.endpoint"),
            'tokenEndpoint' => $this->metadata->get("integrations.{$integration}.params.tokenEndpoint"),
            'clientId' => $integrationEntity->get('clientId'),
            'clientSecret' => $integrationEntity->get('clientSecret'),
            'redirectUri' => $redirectUri,
            'accessToken' => $externalAccountEntity->get('accessToken'),
            'refreshToken' => $externalAccountEntity->get('refreshToken'),
            'tokenType' => $externalAccountEntity->get('tokenType'),
        ), $this);

        $this->addToClientMap($client, $integrationEntity, $externalAccountEntity, $userId);

        return $client;
    }

    protected function addToClientMap($client, $integrationEntity, $externalAccountEntity, $userId)
    {
        $this->clientMap[spl_object_hash($client)] = array(
            'client' => $client,
            'userId' => $userId,
            'integration' => $integrationEntity->id,
            'integrationEntity' => $integrationEntity,
            'externalAccountEntity' => $externalAccountEntity,
        );
    }
}
