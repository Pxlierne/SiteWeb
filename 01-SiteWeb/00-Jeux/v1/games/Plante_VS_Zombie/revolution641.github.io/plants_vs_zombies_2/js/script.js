function start() {
    // variables
    document.getElementById('btn').style.display = 'none';
    const game = document.getElementById('game');
    const cursorElems = document.getElementById('CGE');
    const areas = document.getElementById('areas');
    const choicSunEl = document.getElementById('el_sun');
    const choicAttackEl = document.getElementById('el_pow');
    const lapt = document.getElementById('lpt');
    const zombY = [63, 170, 287, 390, 508];
    const sound = new Audio('./audio/plants_vs_zombies_04 - Grasswalk.mp3');
    sound.play();
    sound.volume = 0.3;
    sound.loop = true;

    for (let i = 0; i < 45; i++) {
        areas.innerHTML += `<div class="area"></div>`;
    };

    const area = document.querySelectorAll('.area');
    let isOnCursor = false;
    let sunScore = 50;
    let clss = null,
        money_sun = null,
        clkSunb = false,
        clkAttb = false,
        laptB = false,
        gr = 7,
        win = false;

    // functions
    function showCursorElement(cls) {
        if (isOnCursor) {
            areas.classList.add('on');
            cursorElems.classList.add(cls);
            isOnCursor = false;
        } else {
            areas.classList.remove('on');
            cursorElems.classList.remove('sun');
            cursorElems.classList.remove('power');
            cursorElems.classList.remove('lap');
            isOnCursor = true;
        }
    }

    function getSunScore(sc) {
        if (sc) {
            sunScore += sc;
        }
        if (sunScore >= 50) {
            choicSunEl.classList.remove('not_mony');
        } else {
            choicSunEl.classList.add('not_mony');
        }
        if (sunScore >= 100) {
            choicAttackEl.classList.remove('not_mony');
        } else {
            choicAttackEl.classList.add('not_mony');
        }
        document.getElementById('sun_len').innerHTML = sunScore;
    }
    function createSunPlant() {
        const sp = document.createElement('div');
        sp.classList.add('sunPlant');
        sp.classList.add('plants');
        sp.setAttribute('health', 10000);
        if (!sp) return;
        if (win) return;
        setInterval(() => {
            const sun = document.createElement('div');
            sun.classList.add('sunn');
            sun.style.top = sp.parentElement.getBoundingClientRect().top + 35 + 'px';
            sun.style.left = sp.parentElement.getBoundingClientRect().left - 135 + 'px';
            game.appendChild(sun);
            setTimeout(() => {
                sun.remove();
            }, 8000);
            sun.addEventListener('click', () => {
                getSunScore(25);
                sun.classList.add('addingSun');
                sun.style.top = '9px';
                sun.style.left = '18px';
                sun.style.opacity = 0;
                setTimeout(() => {
                    sun.remove();
                }, 1000);
            })
        }, 12000)
        setInterval(() => {
            if (sp.getAttribute('health') == 0) {
                sp.remove();
            }
        }, 10)
        return sp;
    }
    function createAttackPlant() {
        const ap = document.createElement('div');
        ap.classList.add('AttackPlant');
        ap.classList.add('plants');
        ap.setAttribute('health', 10000);
        if (win) return;
        setInterval(() => {
            const shoot = document.createElement('div');
            shoot.classList.add('shoot');
            shoot.style.top = ap.parentElement.getBoundingClientRect().top + 27 + 'px';
            shoot.style.left = bx(ap.parentElement, 'left') - 125 + 'px';
            game.appendChild(shoot);
            setInterval(() => {
                if (ax(shoot, 'left') > 860) {
                    shoot.remove();
                }
                shoot.style.left = bx(shoot, 'left') + 100 + 'px';
                const zombies = document.querySelectorAll('.zombie');
                zombies.forEach(z => {
                    if (
                        ax(shoot, 'left') >= ax(z, 'left')
                        &&
                        // bx(shoot, 'right') >= bx(z, 'right') &&
                        ax(shoot, 'top') + 10 >= ax(z, 'top')
                        &&
                        ax(shoot, 'bottom') >= ax(z, 'bottom')
                    ) {
                        z.classList.add('war')
                        z.setAttribute('health', parseInt(z.getAttribute('health')) - 20);
                        setTimeout(() => {
                            z.classList.remove('war');
                        }, 200)
                        shoot.parentElement.removeChild(shoot);
                    }
                })
            }, 100)
            setTimeout(() => {
                shoot.remove();
            }, 3000);
        }, 4000)
        setInterval(() => {
            if (ap.getAttribute('health') == 0) {
                ap.remove();
            }
        }, 10)
        return ap;
    }
    function setTIM() {
        if (win) return;
        setInterval(() => {
            const sun = document.createElement('div');
            sun.classList.add('sunn');
            sun.style.top = '-100px';
            sun.style.transition = '5s';
            setTimeout(() => {
                sun.style.top = Math.random() * 300 + 200 + 'px';
            }, 1000)
            sun.style.left = Math.random() * 600 + 100 + 'px';
            game.appendChild(sun);
            setTimeout(() => {
                sun.remove();
            }, 8000);
            sun.addEventListener('click', () => {
                getSunScore(25);
                sun.style.transition = '.4s';
                sun.classList.add('addingSun');
                sun.style.top = '9px';
                sun.style.left = '18px';
                sun.style.opacity = 0;
                setTimeout(() => {
                    sun.remove();
                }, 1000);
            })
        }, 12000)
    }
    function MoneyBool() {
        if (clkSunb) {
            choicSunEl.classList.add('coldown');
            setTimeout(() => {
                choicSunEl.classList.remove('coldown');
                clkSunb = false;
            }, 10000)
        }
        if (clkAttb) {
            choicAttackEl.classList.add('coldown');
            setTimeout(() => {
                choicAttackEl.classList.remove('coldown');
                clkAttb = false;
            }, 10000)
        }
    }
    function ax(x, y) {
        return parseInt(window.getComputedStyle(x).getPropertyValue(y));
    }
    function bx(x, y) {
        // return parseInt(window.getComputedStyle(x.parentElement).getPropertyValue(y))
        switch (y) {
            case 'left':
                return parseInt(x.getBoundingClientRect().left);
            case 'top':
                return parseInt(x.getBoundingClientRect().top);
            case 'bottom':
                return parseInt(x.getBoundingClientRect().bottom);
            case 'right':
                return parseInt(x.getBoundingClientRect().right);
        }
    }
    function generateZombies() {
        if (win) return;
        setTimeout(() => {
            document.querySelector('.zombrange').style.display = 'block';
            const niter2 = setInterval(() => {
                const zombie = document.createElement('div');
                zombie.classList.add('zombie');
                zombie.style.top = zombY[Math.floor(Math.random() * 5)] + 'px';
                zombie.setAttribute('health', 100)
                if (gr <= 38) {
                    game.appendChild(zombie);
                    gr += 3;
                }
                console.log(gr);
                document.querySelector('.hhd').style.width = gr * 2 + '%';
                const niter1 = setInterval(() => {
                    // const plants = document.querySelectorAll('.plants');
                    // plants.forEach(p => {
                    //     if(
                    //         bx(p, 'left') >= bx(zombie,'left') - 50  &&
                    //         bx(p, 'right') >= bx(zombie, 'right') &&
                    //         bx(p,'top') >= bx(zombie, 'top') &&
                    //         bx(p, 'bottom') >= bx(zombie, 'bottom')
                    //         ){
                    //             console.log(`
                    //             zt(${bx(zombie, 'top') }) = pt(${bx(p,'top')})
                    //             zb(${bx(zombie, 'bottom') }) = pb(${bx(p,'bottom')})
                    //             zl(${bx(zombie, 'left') }) = pl(${bx(p,'left')})
                    //             zr(${bx(zombie, 'right') }) = pr(${bx(p,'right')})
                    //             `);
                    //         zombie.classList.add('stop');
                    //         p.classList.add('plantWarning');
                    //         p.setAttribute('health', parseFloat(p.getAttribute('health')) - 10);
                    //         if(parseInt(p.getAttribute('health')) == 0){
                    //             zombie.classList.remove('stop');
                    //         }
                    //     }else{
                    //         zombie.classList.remove('stop');
                    //     }
                    // });
                    // console.log('zombie', ax(zombie, 'left'));
                    if (ax(zombie, 'left') < -98) {
                        clearInterval(niter1);
                        clearInterval(niter2);
                        window.location.reload();
                        alert('You Lose');
                    }
                    if (zombie.getAttribute('health') == 0) {
                        zombie.remove();
                    }
                    if (gr >= 38 && document.querySelectorAll('.zombie').length == 0) {
                        clearInterval(niter1);
                        clearInterval(niter2);
                        window.location.reload();
                        sound.pause();
                        win = true;
                        alert('You Win!!');
                    }
                }, 10)
            }, 8000)
        }, 30000)
    }

    // addEventListerners
    game.addEventListener('mousemove', (e) => {
        cursorElems.style.top = e.y - game.getBoundingClientRect().top - 65 + 'px';
        cursorElems.style.left = e.x - game.getBoundingClientRect().left - 35 + 'px';
    });
    lapt.addEventListener('click', () => {
        isOnCursor = true;
        laptB = true;
        // clkSunb = false;
        // clkAttb = false;
        clss = 'lap';
        showCursorElement('lap')
    });
    choicSunEl.addEventListener('click', () => {
        if (sunScore < 50 || clkSunb) return;
        clkSunb = true;
        isOnCursor = true;
        laptB = false;
        money_sun = -50;
        clss = 'sun';
        showCursorElement('sun');
    });
    choicAttackEl.addEventListener('click', () => {
        if (sunScore < 100 || clkAttb) return;
        isOnCursor = true;
        laptB = false;
        clkAttb = true;
        money_sun = -100;
        clss = 'AttackPlant';
        showCursorElement('power')
    });
    area.forEach(a => {
        a.addEventListener('click', (e) => {
            if (laptB) {
                a.innerHTML = '';
                laptB = false;
                isOnCursor = false;
                showCursorElement('lap');
                return;
            }
            if (isOnCursor || !clss || !money_sun) return;
            if(a.innerHTML !== '') return;
            a.appendChild(clss == 'sun' ? createSunPlant() : createAttackPlant());
            MoneyBool();
            showCursorElement(clss);
            getSunScore(money_sun);
            clss = null;
            money_sun = null;
            isOnCursor = false;
        });
    });

    getSunScore();
    setTIM();
    generateZombies();
}
