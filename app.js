

const getRemainTime = deadline=>{
    let now = new Date(),
    remainTime = (new Date(deadline)-now + 1000)/1000;
    remainSeconds = ('0' + Math.floor(remainTime %60)).slice(-2),
    remainMinutes = ('0' + Math.floor(remainTime/60 %60)).slice(-2),
    remainHours = ('0' + Math.floor(remainTime /3600 %24)).slice(-2),
    remainDays = Math.floor(remainTime /(3600 *24));

    return{
        remainTime,
        remainSeconds,
        remainMinutes,
        remainHours,
        remainDays,
    }
};

/*timer para los dias */
const countdown=(deadline, elem, finalMessage)=>{
    const el=document.getElementById(elem);

    const timerUpdate=setInterval(()=>{
        let t = getRemainTime(deadline);
        el.innerHTML=`${t.remainDays}`;

        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML=finalMessage;
        }
    }, 1000)

};

/*timer para las horas */
const countdownHoras=(deadline, elem, finalMessage)=>{
    const el=document.getElementById(elem);

    const timerUpdate=setInterval(()=>{
        let t = getRemainTime(deadline);
        el.innerHTML=`${t.remainHours}`;

        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML=finalMessage;
        }
    }, 1000)

};

/*timer para los minutos */
const countdownMin=(deadline, elem, finalMessage)=>{
    const el=document.getElementById(elem);

    const timerUpdate=setInterval(()=>{
        let t = getRemainTime(deadline);
        el.innerHTML=`${t.remainMinutes}`;

        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML=finalMessage;
        }
    }, 1000)

};


/*timer para los segundos */
const countdownSeg=(deadline, elem, finalMessage)=>{
    const el=document.getElementById(elem);

    const timerUpdate=setInterval(()=>{
        let t = getRemainTime(deadline);
        el.innerHTML=`${t.remainSeconds}`;

        if(t.remainTime<=1){
            clearInterval(timerUpdate);
            el.innerHTML=finalMessage;
        }
    }, 1000)

};

countdown('Sep 30 2022 05:30:00 GMT-0600', 'clock', '--')
countdownSeg('Sep 30 2022 05:30:00 GMT-0600', 'segundos', '--')
countdownMin('Sep 30 2022 05:30:00 GMT-0600', 'minutos', '--')
countdownHoras('Sep 30 2022 05:30:00 GMT-0600', 'horas', '--')

console.log(getRemainTime('Sep 30 2022 05:30:00 GMT-0600'));