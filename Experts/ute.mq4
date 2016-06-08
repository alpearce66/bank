//+------------------------------------------------------------------+
//|                                                  MACD Sample.mq4 |
//|                   Copyright 2005-2014, MetaQuotes Software Corp. |
//|                                              http://www.mql4.com |
//+------------------------------------------------------------------+
#property copyright "ALPearce"
#property link      "https://www.mql4.com"
#property version   "1.00"
#property strict

#define LOGGER  11

#include "../ute/EAU_Utilities.mqh"
#include "../ute/EAM_Modules.mqh"
#include "../ute/EAA_AccountManagement.mqh"
#include "../ute/EAT_TradeManagement.mqh"
#include "../ute/EAE_EntryRules.mqh"
#include "../ute/EAX_ExitRules.mqh"

//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int OnInit(void)
  {
   EAU_log(10,"OnInit has been called");
   if (EAM_Initialisation()) {
      EAU_log(0,"Initialisation failed\n");
      return(1);
   };
   EventSetTimer(10);
   return(0);
  }
//+------------------------------------------------------------------+
void OnDeinit(const int)
  {
   EAU_log(10,"OnDeinit has been called");
   EventKillTimer();
  }
//+------------------------------------------------------------------+
void OnTimer(void)
  {
   EAU_log(10,"OnTimer has been called");
   if (EAM_EntryPoint()) {
      EAU_log(0,"EA process has failed\n");
      EventKillTimer();
   };
  }
