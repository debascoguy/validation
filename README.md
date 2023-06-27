# validation
A PHP 8.2+ Attribute Based Valdiation For Properties of Object/Entity/DTO. Comes with in-built data-type converter that can be implmented to make validation easy without compromising your object. You can create your own custom Validators and/or Converter by implmenting a simple interface. 

#Example
 ```
 <?php
 
class LoginAttempt
{
    /**
     * @var int|null
     */
    #[Min(1)]
    protected ?int $id = null;

    /**
     * @var string|null
     */
    #[Required]
    #[AlphaNumeric]
    protected ?string $username = null;
	
	/**
     * @var string|null
     */
    #[Required]
    #[Email]
    protected ?string $email = null;

    /**
     * @var string|null
     */
    #[Required]
    #[AlphaNumeric]
    protected ?string $computername = null;

    /**
     * @var string|null
     */
    #[Required]
    #[IpAddress]
    protected ?string $ipaddress = null;

    /**
     * @var \DateTime|null
     */
    #[Required]
    #[DateTimeFormat]
    protected ?\DateTime $time_created = null;
	
}

//Let's Validate this object
$loginAttempt = new LoginAttempt();

$violations = ValidationFactory::validate($loginAttempt);
if ($violations->valid()) {
	var_dump($violations->getArrayCopy());
}

```
That's easy right! 
No complication, no stress, just use PHP 8 Attribute to validate your object easily without any hassle. Enjoy.

 