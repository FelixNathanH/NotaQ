﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
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
            var authToken = "908c2de9e087c3897b4db82bb8a6b134";
            TwilioClient.Init(accountSid, authToken);

            var messageOptions = new CreateMessageOptions(
              new PhoneNumber("whatsapp:+6281377637521"));
            messageOptions.From = new PhoneNumber("whatsapp:+14155238886");
            messageOptions.Body = "Test message";


            var message = MessageResource.Create(messageOptions);
            Console.WriteLine(message.Body);
        }

    }
}