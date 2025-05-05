import { useState } from 'react'

function App() {
  const [reply, setReply] = useState('')

  const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault()
  }

  return (
    <div>
      <form onSubmit={handleSubmit}>
        <label htmlFor="input">Input: </label>
        <input id="input" type="text" />{' '}
        <button>Send</button>
      </form>
      <p>Reply: {reply}</p>
    </div>
  )
}

export default App
