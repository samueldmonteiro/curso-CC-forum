export function newMessage(content, type){

	if(type == 'error') type = 'danger';

	const message = document.createElement('div');
	const style = `alert-${type}`;
	message.classList.add('alert', style);
	message.innerText = content;
	return message;
}

