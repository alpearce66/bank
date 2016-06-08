//+------------------------------------------------------------------+
//|                                                  EaFunctions.mqh |
//|                                                       A.L.Pearce |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "A.L.Pearce"
#property link      "https://www.mql5.com"
#property strict

//+------------------------------------------------------------------+
void EAU_log(int level, string text)
  {
   if (LOGGER > level) {
      Print(text);
   }
  }
