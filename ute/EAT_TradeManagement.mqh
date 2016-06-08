//+------------------------------------------------------------------+
//|                                                  EaFunctions.mqh |
//|                                                       A.L.Pearce |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "A.L.Pearce"
#property link      "https://www.mql5.com"
#property strict

//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int EAT_Initialisation(void)
  {
   EAU_log(10,"EAT data initialisation has been called");
   return (0);
  }
//+------------------------------------------------------------------+
int EAT_GetTradeData(void)
  {
   EAU_log(10,"EAT get trade data has been called");
   
   EAU_log(10,StringConcatenate(Symbol()," => ",SymbolInfoDouble(Symbol(),SYMBOL_ASK)," : ",MarketInfo(Symbol(),MODE_MINLOT)));
   EAU_log(10,StringConcatenate("EURGBP"," => ",SymbolInfoDouble("USSoybean",SYMBOL_ASK)," : ",MarketInfo("USSoybean",MODE_MINLOT)));

   
   
   return (0);
  }
//+------------------------------------------------------------------+
int EAT_SaveTradeData(void)
  {
   EAU_log(10,"EAT save trade data has been called");
   double minLot    = MarketInfo("EURUSD",MODE_MINLOT);
  // ticket=OrderSend(Symbol(), OP_SELLSTOP, olots, MarketInfo(symbol, MODE_ASK),maxSlippage, 0,0,"",MagicNumber,0,Green);
   return (0);
  }
//+------------------------------------------------------------------+
