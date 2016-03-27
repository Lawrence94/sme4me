var cards = {
  0:{0:"Invalid",1:"ISO/TC",2:"n",3:""},
  1:{0:"Invalid",1:"Airlines",2:"n",3:""},
  100196:{0:"Invalid",1:"ANA Milage",2:"n",3:""},
  134000:{0:"Invalid",1:"Odeon Premiére Club",2:"n",3:""},
  1777:{0:"Invalid",1:"PAG UATP",2:"n",3:""},
  141281:{0:"Invalid",1:"Lounge Club Access",2:"n",3:""},
  14653:{0:"Invalid",1:"PAG Gold UATP",2:"n",3:""},
  14983:{0:"Invalid",1:"UATP",2:"n",3:""},
  2:{0:"Invalid",1:"Airlines",2:"n",3:""},
  2014:{0:"Invalid",1:"Diners Club enRoute",2:"n",3:15,4:""},
  2149:{0:"Invalid",1:"Diners Club enRoute",2:"n",3:15,4:""},
  3:{0:"Invalid",1:"Travel",2:"n",3:""},
  34:{0:"American Express",1:"",2:"y",3:15,4:"l"},
  36:{0:"Diners Club Int.",1:"",2:"y",3:14,4:"l"},
  37:{0:"American Express",1:"",2:"y",3:15,4:"l"},
  4:{0:"Visa",1:"",2:"y",3:""},
  4026:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  417500:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  4405:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  4508:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  4844:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  4913:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  4917:{0:"Visa Electron",1:"",2:"y",3:16,4:"l"},
  5:{0:"Mastercard",1:"",2:"y",3:16,4:"l"},
  56:{0:"Maestro",1:"",2:"y",3:""},
  57:{0:"ATM/Debit Cards",1:"",2:"y",3:""},
  58:{0:"ATM/Debit Cards",1:"",2:"y",3:""},
  59:{0:"Invalid?",1:"",2:"n",3:""},
  6:{0:"Various ATM/Cash/Debit",1:"",2:"y",3:""},
  62:{0:"China UnionPay",1:"",2:"y",3:"",4:""},
  63:{0:"Maestro",1:"",2:"y",3:""},
  65:{0:"Discover Card",1:"",2:"y",3:""},
  67:{0:"Maestro",1:"",2:"y",3:16,4:"l"},
  69:{0:"Invalid?",1:"",2:"n",3:""},
  7:{0:"Invalid",1:"Petrol",2:"n",3:""},
  8:{0:"Invalid",1:"Healthcard/Telecomms",2:"n",3:""},
  88:{0:"China UnionPay",1:"",2:"y",3:"",4:""},
  89:{0:"Invalid",1:"Telecomms",2:"n",3:""},
  8901:{0:"Invalid",1:"US SIM",2:"n",3:""},
  8914:{0:"Invalid",1:"US SIM",2:"n",3:""},
  890126:{0:"Invalid",1:"T-Mobile US SIM",2:"n",3:""},
  890141:{0:"Invalid",1:"AT&amp;T Mobility  US SIM",2:"n",3:""},
  891480:{0:"Invalid",1:"Verizon Wireless US SIM",2:"n",3:""},
  894410:{0:"Invalid",1:"Vodafone UK SIM",2:"n",3:""},
  894411:{0:"Invalid",1:"O2 UK SIM",2:"n",3:""},
  894412:{0:"Invalid",1:"Orange UK SIM",2:"n",3:""},
  894420:{0:"Invalid",1:"Three UK SIM",2:"n",3:""},
  894430:{0:"Invalid",1:"T-Mobile UK SIM",2:"n",3:""},
  894901:{0:"Invalid",1:"HappyDigits Member Card",2:"n",3:""},
  894922:{0:"Invalid",1:"O2 Germany Netzclub SIM",2:"n",3:""},
  9:{0:"Invalid",1:"Loyalty Cards",2:"n",3:""},
  921017:{0:"Invalid",1:"Waitrose Card",2:"n",3:""},
  982613:{0:"Invalid",1:"NUS Card",2:"n",3:""},
  982615:{0:"Invalid",1:"Waterstops Loyalty Card",2:"n",3:""},
  982630:{0:"Invalid",1:"Nectar Card",2:"n",3:""}
};

var cardlen = "";
var cardchk = "";

$("#card").bind("propertychange input paste", function() {
  
  cardno = $("#card").val();
  if ((cardno == null) || (cardno == undefined) || (cardno == "")) { 
    cardtype = "";
    $("body").removeClass("invalid");
    $("#card").removeAttr('maxlength');
  } else if ((cards[cardno] != null) || (cards[cardno] != undefined)) {
    cardtype = cards[cardno][0];
    if ((cards[cardno][1] != null) && (cards[cardno][1] != "") && (cards[cardno][1] != undefined)) {
      cardtype = cards[cardno][1];
    }
    cardlen = cards[cardno][3];
    $("#card").attr('maxlength',cardlen);
    cardchk = cards[cardno][4];
    if(cards[cardno][2] == "n") {
      $("body").addClass("invalid");
      $("#card").removeAttr('maxlength');
    } else {
      $("body").removeClass("invalid");
    }
  }

  // @todo - Add Proper length checks
  if ((cardno.length == cardlen)&&(cardlen != "")) {
  	alert("Correct Card Number Length");
  	// @ todo - Add Luhn Checking
  	if ((cardchk == "l")) {
		alert("Perfom Luhn Check");
  	}
  }
  
  $("#output").html(cardtype);
});