using System;
using Twilio;
using Twilio.Rest.Api.V2010.Account;
using Twilio.Types;


namespace NotaQ.Whatsapp
{
    public class Twilio
    {
        public static void SendMessage()
        {
            var accountSid = "ACac3d89fa0ece8bad6daab30946ebb4ba";
            var authToken = "f646565317c1e2f8e46e09eb59f0eb4e";
            TwilioClient.Init(accountSid, authToken);

            var messageOptions = new CreateMessageOptions(
              new PhoneNumber("whatsapp:+6281377637521"));
            messageOptions.From = new PhoneNumber("whatsapp:+14155238886");
            messageOptions.Body = "Test message";


            var message = MessageResource.Create(messageOptions);
            Console.WriteLine(message.Body);
        }



        public static void SendNota(string phone, string messages)
        {
            string PhoneNum = "whatsapp:" + phone;
            var accountSid = "ACac3d89fa0ece8bad6daab30946ebb4ba";
            var authToken = "f646565317c1e2f8e46e09eb59f0eb4e";
            TwilioClient.Init(accountSid, authToken);

            var messageOptions = new CreateMessageOptions(
              new PhoneNumber(PhoneNum));
            messageOptions.From = new PhoneNumber("whatsapp:+12513175507");
            messageOptions.Body = messages;


            var message = MessageResource.Create(messageOptions);
            Console.WriteLine(message.Body);
        }

    }
}