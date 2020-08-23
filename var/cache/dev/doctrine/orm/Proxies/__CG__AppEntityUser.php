<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \App\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', '' . "\0" . 'App\\Entity\\User' . "\0" . 'firstName', '' . "\0" . 'App\\Entity\\User' . "\0" . 'lastName', '' . "\0" . 'App\\Entity\\User' . "\0" . 'experience', '' . "\0" . 'App\\Entity\\User' . "\0" . 'mappings', '' . "\0" . 'App\\Entity\\User' . "\0" . 'eAFs', '' . "\0" . 'App\\Entity\\User' . "\0" . 'entreprises', '' . "\0" . 'App\\Entity\\User' . "\0" . 'evaluateEntreprise', '' . "\0" . 'App\\Entity\\User' . "\0" . 'expertEntreprise', '' . "\0" . 'App\\Entity\\User' . "\0" . 'evaluationElements', '' . "\0" . 'App\\Entity\\User' . "\0" . 'preferences', '' . "\0" . 'App\\Entity\\User' . "\0" . 'binaireEvaluations', '' . "\0" . 'App\\Entity\\User' . "\0" . 'created_eaf', '' . "\0" . 'App\\Entity\\User' . "\0" . 'generated_by', '' . "\0" . 'App\\Entity\\User' . "\0" . 'domain', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'plainPassword', 'lastLogin', 'confirmationToken', 'passwordRequestedAt', 'groups', 'roles'];
        }

        return ['__isInitialized__', 'id', '' . "\0" . 'App\\Entity\\User' . "\0" . 'firstName', '' . "\0" . 'App\\Entity\\User' . "\0" . 'lastName', '' . "\0" . 'App\\Entity\\User' . "\0" . 'experience', '' . "\0" . 'App\\Entity\\User' . "\0" . 'mappings', '' . "\0" . 'App\\Entity\\User' . "\0" . 'eAFs', '' . "\0" . 'App\\Entity\\User' . "\0" . 'entreprises', '' . "\0" . 'App\\Entity\\User' . "\0" . 'evaluateEntreprise', '' . "\0" . 'App\\Entity\\User' . "\0" . 'expertEntreprise', '' . "\0" . 'App\\Entity\\User' . "\0" . 'evaluationElements', '' . "\0" . 'App\\Entity\\User' . "\0" . 'preferences', '' . "\0" . 'App\\Entity\\User' . "\0" . 'binaireEvaluations', '' . "\0" . 'App\\Entity\\User' . "\0" . 'created_eaf', '' . "\0" . 'App\\Entity\\User' . "\0" . 'generated_by', '' . "\0" . 'App\\Entity\\User' . "\0" . 'domain', 'username', 'usernameCanonical', 'email', 'emailCanonical', 'enabled', 'salt', 'password', 'plainPassword', 'lastLogin', 'confirmationToken', 'passwordRequestedAt', 'groups', 'roles'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName(?string $firstName): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', [$firstName]);

        return parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', []);

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName(?string $lastName): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', [$lastName]);

        return parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function getExperience(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExperience', []);

        return parent::getExperience();
    }

    /**
     * {@inheritDoc}
     */
    public function setExperience(?int $experience): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExperience', [$experience]);

        return parent::setExperience($experience);
    }

    /**
     * {@inheritDoc}
     */
    public function getMappings(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMappings', []);

        return parent::getMappings();
    }

    /**
     * {@inheritDoc}
     */
    public function addMapping(\App\Entity\Mapping $mapping): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMapping', [$mapping]);

        return parent::addMapping($mapping);
    }

    /**
     * {@inheritDoc}
     */
    public function removeMapping(\App\Entity\Mapping $mapping): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeMapping', [$mapping]);

        return parent::removeMapping($mapping);
    }

    /**
     * {@inheritDoc}
     */
    public function getEAFs(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEAFs', []);

        return parent::getEAFs();
    }

    /**
     * {@inheritDoc}
     */
    public function addEAF(\App\Entity\EAF $eAF): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEAF', [$eAF]);

        return parent::addEAF($eAF);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEAF(\App\Entity\EAF $eAF): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEAF', [$eAF]);

        return parent::removeEAF($eAF);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntreprises(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEntreprises', []);

        return parent::getEntreprises();
    }

    /**
     * {@inheritDoc}
     */
    public function addEntreprise(\App\Entity\Entreprise $entreprise): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEntreprise', [$entreprise]);

        return parent::addEntreprise($entreprise);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEntreprise(\App\Entity\Entreprise $entreprise): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEntreprise', [$entreprise]);

        return parent::removeEntreprise($entreprise);
    }

    /**
     * {@inheritDoc}
     */
    public function getEvaluateEntreprise(): ?\App\Entity\Entreprise
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEvaluateEntreprise', []);

        return parent::getEvaluateEntreprise();
    }

    /**
     * {@inheritDoc}
     */
    public function setEvaluateEntreprise(?\App\Entity\Entreprise $evaluateEntreprise): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEvaluateEntreprise', [$evaluateEntreprise]);

        return parent::setEvaluateEntreprise($evaluateEntreprise);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpertEntreprise(): ?\App\Entity\Entreprise
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpertEntreprise', []);

        return parent::getExpertEntreprise();
    }

    /**
     * {@inheritDoc}
     */
    public function setExpertEntreprise(?\App\Entity\Entreprise $expertEntreprise): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpertEntreprise', [$expertEntreprise]);

        return parent::setExpertEntreprise($expertEntreprise);
    }

    /**
     * {@inheritDoc}
     */
    public function getEvaluationElements(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEvaluationElements', []);

        return parent::getEvaluationElements();
    }

    /**
     * {@inheritDoc}
     */
    public function addEvaluationElement(\App\Entity\EvaluationElements $evaluationElement): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addEvaluationElement', [$evaluationElement]);

        return parent::addEvaluationElement($evaluationElement);
    }

    /**
     * {@inheritDoc}
     */
    public function removeEvaluationElement(\App\Entity\EvaluationElements $evaluationElement): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeEvaluationElement', [$evaluationElement]);

        return parent::removeEvaluationElement($evaluationElement);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreferences(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPreferences', []);

        return parent::getPreferences();
    }

    /**
     * {@inheritDoc}
     */
    public function addPreference(\App\Entity\Preferences $preference): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPreference', [$preference]);

        return parent::addPreference($preference);
    }

    /**
     * {@inheritDoc}
     */
    public function removePreference(\App\Entity\Preferences $preference): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePreference', [$preference]);

        return parent::removePreference($preference);
    }

    /**
     * {@inheritDoc}
     */
    public function getBinaireEvaluations(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBinaireEvaluations', []);

        return parent::getBinaireEvaluations();
    }

    /**
     * {@inheritDoc}
     */
    public function addBinaireEvaluation(\App\Entity\BinaireEvaluation $binaireEvaluation): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addBinaireEvaluation', [$binaireEvaluation]);

        return parent::addBinaireEvaluation($binaireEvaluation);
    }

    /**
     * {@inheritDoc}
     */
    public function removeBinaireEvaluation(\App\Entity\BinaireEvaluation $binaireEvaluation): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeBinaireEvaluation', [$binaireEvaluation]);

        return parent::removeBinaireEvaluation($binaireEvaluation);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedEaf(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedEaf', []);

        return parent::getCreatedEaf();
    }

    /**
     * {@inheritDoc}
     */
    public function addCreatedEaf(\App\Entity\EAF $createdEaf): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCreatedEaf', [$createdEaf]);

        return parent::addCreatedEaf($createdEaf);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCreatedEaf(\App\Entity\EAF $createdEaf): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCreatedEaf', [$createdEaf]);

        return parent::removeCreatedEaf($createdEaf);
    }

    /**
     * {@inheritDoc}
     */
    public function getGeneratedBy(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGeneratedBy', []);

        return parent::getGeneratedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setGeneratedBy(?string $generated_by): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGeneratedBy', [$generated_by]);

        return parent::setGeneratedBy($generated_by);
    }

    /**
     * {@inheritDoc}
     */
    public function getDomain(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDomain', []);

        return parent::getDomain();
    }

    /**
     * {@inheritDoc}
     */
    public function setDomain(string $domain): \App\Entity\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDomain', [$domain]);

        return parent::setDomain($domain);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function addRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addRole', [$role]);

        return parent::addRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'serialize', []);

        return parent::serialize();
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'unserialize', [$serialized]);

        return parent::unserialize($serialized);
    }

    /**
     * {@inheritDoc}
     */
    public function eraseCredentials()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'eraseCredentials', []);

        return parent::eraseCredentials();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsernameCanonical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsernameCanonical', []);

        return parent::getUsernameCanonical();
    }

    /**
     * {@inheritDoc}
     */
    public function getSalt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSalt', []);

        return parent::getSalt();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function getEmailCanonical()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmailCanonical', []);

        return parent::getEmailCanonical();
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getPlainPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPlainPassword', []);

        return parent::getPlainPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function getLastLogin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastLogin', []);

        return parent::getLastLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function getConfirmationToken()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getConfirmationToken', []);

        return parent::getConfirmationToken();
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRoles', []);

        return parent::getRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function hasRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasRole', [$role]);

        return parent::hasRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAccountNonExpired', []);

        return parent::isAccountNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isAccountNonLocked()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isAccountNonLocked', []);

        return parent::isAccountNonLocked();
    }

    /**
     * {@inheritDoc}
     */
    public function isCredentialsNonExpired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isCredentialsNonExpired', []);

        return parent::isCredentialsNonExpired();
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isEnabled', []);

        return parent::isEnabled();
    }

    /**
     * {@inheritDoc}
     */
    public function isSuperAdmin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isSuperAdmin', []);

        return parent::isSuperAdmin();
    }

    /**
     * {@inheritDoc}
     */
    public function removeRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeRole', [$role]);

        return parent::removeRole($role);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', [$username]);

        return parent::setUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function setUsernameCanonical($usernameCanonical)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsernameCanonical', [$usernameCanonical]);

        return parent::setUsernameCanonical($usernameCanonical);
    }

    /**
     * {@inheritDoc}
     */
    public function setSalt($salt)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSalt', [$salt]);

        return parent::setSalt($salt);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function setEmailCanonical($emailCanonical)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmailCanonical', [$emailCanonical]);

        return parent::setEmailCanonical($emailCanonical);
    }

    /**
     * {@inheritDoc}
     */
    public function setEnabled($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnabled', [$boolean]);

        return parent::setEnabled($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setSuperAdmin($boolean)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSuperAdmin', [$boolean]);

        return parent::setSuperAdmin($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function setPlainPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPlainPassword', [$password]);

        return parent::setPlainPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function setLastLogin(\DateTime $time = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastLogin', [$time]);

        return parent::setLastLogin($time);
    }

    /**
     * {@inheritDoc}
     */
    public function setConfirmationToken($confirmationToken)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setConfirmationToken', [$confirmationToken]);

        return parent::setConfirmationToken($confirmationToken);
    }

    /**
     * {@inheritDoc}
     */
    public function setPasswordRequestedAt(\DateTime $date = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPasswordRequestedAt', [$date]);

        return parent::setPasswordRequestedAt($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getPasswordRequestedAt()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPasswordRequestedAt', []);

        return parent::getPasswordRequestedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function isPasswordRequestNonExpired($ttl)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isPasswordRequestNonExpired', [$ttl]);

        return parent::isPasswordRequestNonExpired($ttl);
    }

    /**
     * {@inheritDoc}
     */
    public function setRoles(array $roles)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRoles', [$roles]);

        return parent::setRoles($roles);
    }

    /**
     * {@inheritDoc}
     */
    public function getGroups()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroups', []);

        return parent::getGroups();
    }

    /**
     * {@inheritDoc}
     */
    public function getGroupNames()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroupNames', []);

        return parent::getGroupNames();
    }

    /**
     * {@inheritDoc}
     */
    public function hasGroup($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasGroup', [$name]);

        return parent::hasGroup($name);
    }

    /**
     * {@inheritDoc}
     */
    public function addGroup(\FOS\UserBundle\Model\GroupInterface $group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addGroup', [$group]);

        return parent::addGroup($group);
    }

    /**
     * {@inheritDoc}
     */
    public function removeGroup(\FOS\UserBundle\Model\GroupInterface $group)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeGroup', [$group]);

        return parent::removeGroup($group);
    }

}