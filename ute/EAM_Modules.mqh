//+------------------------------------------------------------------+
//|                                                  EaFunctions.mqh |
//|                                                       A.L.Pearce |
//|                                             https://www.mql5.com |
//+------------------------------------------------------------------+
#property copyright "A.L.Pearce"
#property link      "https://www.mql5.com"
#property strict

//+------------------------------------------------------------------+
int EAM_Initialisation(void)
  {
   EAU_log(10,"EAM data initialisation has been called");
   EAT_Initialisation();
   return (0);
  }
//+------------------------------------------------------------------+
int EAM_EntryPoint(void)
  {
   EAU_log(10,"EAM standard entry point has been called");
   EAM_ListedTrades();
   EAM_RecentlyClosed();
   EAM_RecentlyOpened();
   return (0);
  }
//+------------------------------------------------------------------+
int EAM_ListedTrades(void)
  {
   EAU_log(10,"EAM listed trades has been called");
   
   EAT_GetTradeData();
   
   return (0);
  }
//+------------------------------------------------------------------+
int EAM_RecentlyClosed(void)
  {
   EAU_log(10,"EAM recently closed has been called");
   return (0);
  }
//+------------------------------------------------------------------+
int EAM_RecentlyOpened(void)
  {
   EAU_log(10,"EAM recently opened has been called");
   return (0);
  }
//+------------------------------------------------------------------+
