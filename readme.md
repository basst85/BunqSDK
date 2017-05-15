# Bunq-SDK

**Disclaimer: This project is not made by the company bunq itself.**

This SDK is used to communicate with the bunq public API using PHP. For more info on this API please visit doc.bunq.com
each object in this SDK corresponds with an API call.

## Usage

The first steps in making API calls is creating an Installation, DeviceServer and starting a session this is done in the BunqSession class:

    $session = new BunqSession();
    $session->createInstallation($installation);
    $session->createDeviceServer($deviceServer);
    $session->createSessionServer($sessionServer);
    
After these API calls it is possible to use the BunqSession to make other API calls. For example:
    
    $session->post($payment);
    $session->get($monetaryAccount);
    $session->put($monetaryAccountBank);
    $session->delete($tabItemShop);
    
The API calls are made using the objects corresponding with the calls from doc.bunq.com, these objects contain the endpoint, the request attributes and the response attributes.
The correct way to use these objects to make calls is:
    
    //Create a new object.
    $payment = new Payment($endpoint);
    
    //Add the data to the object. 
    $payment->setAmountValue('13.37');
    $payment->setAmountCurrency('EUR');
    $payment->setCounterPartyAliasType('EMAIL');
    $payment->setCounterPartyAliasValue('info@jellevanhengel.com');
    $payment->setDescription('Gin Tonics! <3');
    
    //Make the post call.
    $session->post($payment);
    
    //Extract the needed data from the object.
    $paymentId = $payment->getId();
    
This way you'll only need to specify the request attributes and the endpoint, and all the data will be easy to access from the object.


## Status

since this is a "Work in progress" project, not all API calls are implemented yet.
Here is a list to see which ones are:

- Setup
	- [X] Installation
	- [ ] InstallationServerPublicKey
	- [ ] Device
	- [X] DeviceServer
	- [ ] PermittedIp
	- [ ] UserCredentialPasswordIp
	- [X] Session
	- [X] SessionServer
- Payments
    - [X] Payment
    - [ ] PaymentBatch
- Requests
    - [ ] RequestInquiry
    - [ ] RequestInquiryBatch
    - [ ] RequestResponse
- DraftPayments
    - [ ] DraftPayment
- ScheduledPayments
    - [ ] SchedulePayment
    - [ ] SchedulePaymentBatch
    - [ ] ScheduleInstance
    - [ ] Schedule
    - [ ] ScheduleUser
- TabPayments
    - [ ] TabUsageSimple
    - [ ] TabUsageMultiple
    - [ ] TabItem
    - [ ] TabItemBatch
    - [ ] Tab
    - [ ] TabQrCodeContent
    - [ ] TabResultInquiry
    - [ ] TabResultResponse
- CardPayments
    - [ ] MastercardAction
- IdealPayments
    - [ ] TokenQrRequestIdeal
- User
    - [X] User
    - [ ] UserPerson
    - [ ] UserCompany
- MonetaryAccounts
    - [X] MonetaryAccount
    - [X] MonetaryAccountBank
- CashRegisters
    - [ ] CashRegister
    - [ ] CashRegisterQrCode
    - [ ] CashRegisterQrCodeContent
- Connects
    - [ ] ShareInviteBankInquiry
    - [ ] ShareInviteBankResponse
    - [ ] ShareInviteBankAmountUsed
    - [ ] DraftShareInviteBank
    - [ ] DraftShareInviteBankQr
    - [ ] CodeContent
- Cards
    - [ ] Card
    - [ ] CardDebit
    - [ ] CardName
- Chat
    - [ ] PaymentChat
    - [ ] RequestInquiryChat
    - [ ] RequestResponseChat
    - [ ] ChatConversation
    - [ ] ChatMessage
    - [ ] ChatMessageAttachment
    - [ ] ChatMessageText
- Callbacks
    - [ ] CertificatePinned
-Attachments
    - [ ] Avatar
    - [ ] AttachmentPublic
    - [ ] AttachmentPublicContent
    - [ ] AttachmentMonetaryAccount
    - [ ] AttachmentTab
    - [ ] AttachmentTabContent
    - [ ] TabAttachmentTab
    - [ ] TabAttachmentTabContent
    - [ ] AttachmentConversation
    - [ ] AttachmentConversationContent
- Invoices
    - [ ] Invoice
    - [ ] InvoiceByUser
- Export Statements
    - [ ] CustomerStatementExport
    - [ ] CustomerStatementExportContent
    - [ ] CustomerStatementExport
    - [ ] ExportAnnualOverview
    - [ ] ExportAnnualOverviewContent
    
## Examples

Here are some more examples.

Posting a new installation:

    //Create the installation object with the client public key and the correct endpoint.
    $installation = new Installation('installation');
    
    //Add the data to the installation object.
    $installation->setClientPublicKey($clientPublicKey);
    
    //Execute the POST installationRequest.
    $session->createInstallation($installation);

Getting the id from a user:
    
    //Create the user object with the correct endpoint.
    $user = new User('user');
    
    //Execute the GET request.
    $session->get($user);
    
    //Extract the id.
    $userId = $user->getUserCompany()->{'id'};
    
Getting the balance from a monetary account:

    //Create the monetaryAccount object with the correct endpoint.
    $monetaryAccount = new MonetaryAccount('user/' . $userId . 'monetary-account');
    
    //Execute the GET request.
    $session->get($monetaryAccount);
    
    //Extract the balance.
    $monetaryAccount->getMonetaryAccountBank()->{'balance'};
  