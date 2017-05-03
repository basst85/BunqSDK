# Bunq-SDK

(Work in progress)

This SDK is used to communicate with the bunq public API using PHP. For more info on this API please visit doc.bunq.com
each object in this SDK corresponds with an API call.

## Usage

To make an API call simply create the object you want to call, for example:

    $deviceServer = new DeviceServer($description, $apiKey, $permittedIps, $httpClient);

After creating the objects you can change the request attributes using the setters and getters.
While it is possible to leave the client null (in that case a client will be created in the API object) it is recommended to create one client and use this for all the API calls.

to finalize and send the request you can use the according methods, for example:

    $deviceServer->post($clientPrivateKey, $installationToken, $serverPublicKey, $customHeaders);

While it is possible to not specify custom headers for the requests (default headers will be used) it is also recommended to use your own custom headers. 

## status

since this is a "Work in progress" project, not all API calls are implemented yet.
Here is a list to see which ones are:

- Setup
	- [x] Installation (POST and GET only)
	- [ ] InstallationServerPublicKey
	- [ ] Device
	- [x] DeviceServer (POST only)
	- [ ] PermittedIp
	- [ ] UserCredentialPasswordIp
	- [ ] Session
	- [x] SessionServer (POST only)
- Payments
    - [ ] Payment
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
    - [ ] User
    - [ ] UserPerson
    - [ ] UserCompany
- MonetaryAccounts
    - [ ] MonetaryAccount
    - [ ] MonetaryAccountBank
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
    