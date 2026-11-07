// ExuraCSS dark mode: one attribute, colors balance themselves
Exura.dom('body').attr('dark', '');

// ExuraJS module: state -> effect -> render
Exura.module(function rune() {
  const { state, effect, render } = rune;

  state.set('message', 'Listening to the runes…');
  state.set('status', 'waiting');
  effect(() => render(), ['message', 'status']);

  // ask ExuraPHP, a Vercel function at /api/rune
  // the "Test API" button calls it again: rune.test()
  rune.test = async () => {
    const begin = performance.now();
    state.set('status', 'calling…');

    try {
      const response = await fetch('/api/rune', { cache: 'no-store' });
      const time = Math.round(performance.now() - begin);
      const json = await response.json();
      state.set('status', `${response.status} · ${time} ms`);
      state.set('message', json.data?.message ?? json.error?.message ?? 'No message');
    } catch (error) {
      state.set('status', 'no answer');
      state.set('message', 'The API sleeps here, deploy it: php vercel push');
    }
  };

  rune.test();
});

rune();

// public/index.html is static: the year comes from the browser
Exura.dom('#year').text(new Date().getFullYear());

// wake the header
document.getElementById('hero').classList.add('awake');
